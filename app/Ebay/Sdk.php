<?php

namespace App\Ebay;

use App\Ebay\Requests\AbstractRequest;
use App\Ebay\Requests\AddFixedPriceItem;
use App\Ebay\Requests\GetCategories;
use App\Ebay\Requests\GetCategoryFeatures;
use App\Ebay\Requests\GetEbayDetails;
use App\Models\Listing;
use Exception;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Sdk
{
    private array $config;
    /** @var EbayTokenRepository */
    private EbayTokenRepository $tokenRepo;
    /** @var ClientInterface */
    private ClientInterface $client;

    public function __construct(EbayTokenRepository $tokenRepo, ClientInterface $client)
    {
        $this->tokenRepo = $tokenRepo;
        $this->client = $client;

        $ebayConfig = config('services.ebay');
        if (
            empty($ebayConfig)
            || empty($ebayConfig['app_id'])
        ) {
            throw new Exception('eBay SDK not properly configured');
        }

        $this->config = $ebayConfig;
    }

    public function getLocations()
    {
        return $this->request('get', 'sell/inventory/v1/location')->locations;
    }

    public function createLocation($id, $data)
    {
        return $this->request('post', "sell/inventory/v1/location/$id", $data);
    }



    public function getCategories(int $parentId = null)
    {
        [$treeId, $treeVersion] = $this->getCategoryTreeMeta();

        $key = 'ebay-category-tree'
            . '|version:' . $treeVersion
            . '|treeId:' . $treeId
            . '|parentId:' . ($parentId ?: 'null');

        $categories = Cache::rememberForever($key, function () use ($parentId, $treeId) {
        //$categories = Cache::remember($key, 1, function () use ($parentId, $treeId) {
            if (is_null($parentId)) {
                $response = $this->request(
                    'get',
                    "commerce/taxonomy/v1/category_tree/$treeId"
                );

                return collect($response->rootCategoryNode->childCategoryTreeNodes)
                    ->map(fn ($node) => [
                        'name' => $node->category->categoryName,
                        'id' => $node->category->categoryId,
                    ])
                    ->sortBy('name')
                    ->mapWithKeys(fn($category) => [$category['id'] => $category['name']]);
            } else {
                $response = $this->request(
                    'get',
                    "commerce/taxonomy/v1/category_tree/$treeId/get_category_subtree",
                    null,
                    ['category_id' => $parentId],
                );

                if (!isset($response->categorySubtreeNode->childCategoryTreeNodes)) {
                    return collect();
                }

                return collect($response->categorySubtreeNode->childCategoryTreeNodes)
                    ->map(fn ($node) => [
                        'name' => $node->category->categoryName,
                        'id' => $node->category->categoryId,
                    ])
                    ->sortBy('name')
                    ->mapWithKeys(fn($category) => [$category['id'] => $category['name']]);
            }
        });

        return $categories;

    }

    private function getCategoryTreeMeta()
    {
        return Cache::remember(
            'ebay-category-tree-version',
            Carbon::now()->addHours(24),
            function () {
                $response = $this->request(
                    'get',
                    'commerce/taxonomy/v1/get_default_category_tree_id',
                    null,
                    ['marketplace_id' => 'EBAY_US'],
                );

                return [$response->categoryTreeId, $response->categoryTreeVersion];
            }
        );
    }

    public function getConditionsPolicyForCategory($categoryId)
    {
        return Cache::remember(
            'ebay-category-conditions' . $categoryId,
            1, //Carbon::now()->addDays(30),
            function () use ($categoryId) {
                $response = $this->request(
                    'get',
                    'sell/metadata/v1/marketplace/EBAY_US/get_item_condition_policies',
                    [],
                    ['filter' => 'categoryId:{'. $categoryId . '}']
                );

                foreach ($response->itemConditionPolicies as $policy) {
                    if ($categoryId == $policy->categoryId) {
                        return $policy;
                    }
                }

                return null;
            }
        );
    }

    private function request($method, $url, $json = [], $query = [])
    {
        $accessToken = $this->getCurrentAccessToken();

        $options = [
            'headers' => [
                'Authorization' => 'Bearer :' . $accessToken,
                'Content-Language' => 'en-US'
            ]
        ];

        if ($json) {
            $options['json'] = $json;
        }

        if ($query) {
            $options['query'] = $query;
        }

        try {
            $response = $this->client->request(
                $method,
                $url,
                $options
            );
        } catch (\Exception $e) {
            Log::info(json_encode($options, JSON_PRETTY_PRINT));
            Log::info($e->getResponse()->getBody()->getContents());
            throw $e;
        }

        return json_decode($response->getBody()->getContents());

    }

    private function getCurrentAccessToken()
    {
        if ($this->tokenRepo->isAccessTokenCurrent()) {
            return $this->tokenRepo->getAccessToken();
        }

        if ($this->tokenRepo->isRefreshTokenCurrent()) {
            $this->tokenRepo->refreshAccessToken();

            return $this->tokenRepo->getAccessToken();
        }

        throw new Exception('Ebay Refresh Token has expired');
    }

    public function createInventoryItem(Listing $listing): int
    {
        $data = [
            'availability' => [
                'shipToLocationAvailability' => [
                    'availabilityDistributions' => [
                        [
                            'merchantLocationKey' => $this->config['merchant_location_key'],
                            'quantity' => $listing->availableItems()->count(),
                        ],
                    ],
                    'quantity' => $listing->availableItems()->count(),
                ],
            ],
            'condition' => $listing->ebay_condition_enum,
            'product' => [
                'description' => $listing->description . ' ' . $listing->features,
                'imageUrls' => $listing->images
                    ->map(fn ($image) => $image->raw_url)
                    ->all(),
                'title' => $listing->title,
            ],
        ];

        if ($listing->brand) {
            $data['product']['brand'] = $listing->brand->name;
        }

        if ($listing->upc) {
            $data['product']['upc'] = [$listing->upc];
        }

        $response = $this->request(
            'put',
            'sell/inventory/v1/inventory_item/' . $this->getEbaySku($listing),
            $data,
        );

        return true;
    }

    public function createOffer(Listing $listing)
    {
        $ebayPrice = $listing->price * (1 + $listing->send_to_ebay_markup/100);

        $data = [
            'categoryId' => $listing->ebay_offer_category_id,
            'format' => 'FIXED_PRICE',
            'listingDescription' => $listing->description . ' ' . $listing->features,
            'listingPolicies' => [
                'bestOfferTerms' => [
                    'bestOfferEnabled' => true,
                ],
                'fulfillmentPolicyId' => $this->config['fulfillment_policy_id'],
                'paymentPolicyId' => $this->config['payment_policy_id'],
                'returnPolicyId' => $this->config['return_policy_id'],
            ],
            'marketplaceId' => 'EBAY_US',
            'merchantLocationKey' => $this->config['merchant_location_key'],
            'pricingSummary' => [
                'price' => [
                    'currency' => 'USD',
                    'value' => $ebayPrice,
                ],
            ],
            'sku' => $this->getEbaySku($listing),
        ];

        $response = $this->request(
            'post',
            'sell/inventory/v1/offer',
            $data
        );

        return $response->offerId;
    }

    public function getPolicies(string $type)
    {
        return $this->request(
            'get',
            'sell/account/v1/' . $type . '_policy',
            [],
            ['marketplace_id' => 'EBAY_US']
        );
    }

    public function createFulfillmentPolicy(array $data)
    {
        return $this->request(
            'post',
            'sell/account/v1/fulfillment_policy',
            $data
        );
    }

    public function createReturnPolicy(array $data)
    {
        return $this->request(
            'post',
            'sell/account/v1/return_policy',
            $data
        );
    }

    public function createPaymentPolicy(array $data)
    {
        return $this->request(
            'post',
            'sell/account/v1/payment_policy',
            $data
        );
    }

    public function publishOffer(string $offerId)
    {
        $response = $this->request(
            'post',
            "sell/inventory/v1/offer/$offerId/publish/",
        );

        dd($response);
    }

    public function getPaymentsProgramStatus()
    {
        return $this->request(
            'get',
            'sell/account/v1/payments_program/EBAY_US/EBAY_PAYMENTS'
        );
    }

    public function getPaymentsProgramOnboardingStatus()
    {
        return $this->request(
            'get',
            'sell/account/v1/payments_program/EBAY_US/EBAY_PAYMENTS/onboarding'
        );
    }

    private function getEbaySku(Listing $listing)
    {
        if (App::environment('production')) {
            return 'website-' . $listing->id;
        }

        return App::environment() . '-' . $listing->id;
    }
}
