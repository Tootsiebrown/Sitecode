<?php

namespace App\Ebay;

use App\Models\Listing;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
                    ['filter' => 'categoryId:{' . $categoryId . '}']
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
        } catch (BadResponseException $e) {
            Log::info(json_encode($options, JSON_PRETTY_PRINT));
            Log::info($e->getResponse()->getBody()->getContents());
            send_mail(
                'davidbaneks@gmail.com',
                'Ebay SDK request error',
                $e->getResponse()->getBody()->getContents(),
                'no-reply@catchndealz.com',
                false
            );
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
                'pickupAtLocationAvailability' => [
                    [
                        'availabilityType' => 'OUT_OF_STOCK',
                        'fullfillmentTime' => [
                            'unit' => 'HOUR',
                            'value' => 1,
                        ],
                        'merchantLocationKey' => $this->config['merchant_location_key'],
                        'quantity' => 0,
                    ],
                ],
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
                'aspects' => [
                    'Brand' => ['Does not apply'], //['20th Century Fox']//[$listing->brand->name],
                ],
                'brand' => 'Does not apply',
                'upc' => ['Does not apply'],
            ],
        ];

        if ($listing->brand) {
            // $data['product']['brand'] = $listing->brand->name;
        }

        $data['product']['mpn'] = 'Does not apply';

        if ($listing->upc) {
            //$data['product']['upc'] = [$listing->upc];
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
        $response = $this->request(
            'post',
            'sell/inventory/v1/offer',
            $this->getOfferDataFromListing($listing)
        );

        return $response->offerId;
    }

    public function refreshOffer(Listing $listing)
    {
        return $this->request(
            'put',
            'sell/inventory/v1/offer/' . $listing->ebay_offer_id,
            $this->getOfferDataFromListing($listing)
        );
    }

    private function getOfferDataFromListing(Listing $listing)
    {
        $ebayPrice = $listing->price * (1 + $listing->send_to_ebay_markup / 100);
        $data = [
            'availableQuantity' => $listing->availableItems()->count(),
            'categoryId' => $listing->ebay_offer_category_id,
            'format' => 'FIXED_PRICE',
            'includeCatalogProductDescription' => false,
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

        return $data;
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
            "sell/inventory/v1/offer/$offerId/publish",
        );

        return $response->listingId;
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

    public function getAspectsForCategory($categoryId)
    {
        [$treeId, $treeVersion] = $this->getCategoryTreeMeta();

        $key = 'ebay|category-aspects|treeId:'
            . $treeId
            . '|treeVersion:'
            . $treeVersion
            . '|categoryId:'
            . $categoryId;

        $response = Cache::rememberForever($key, function () use ($treeId, $categoryId) {
            try {
                return $this->request(
                    'get',
                    'commerce/taxonomy/v1/category_tree/' . $treeId . '/get_item_aspects_for_category',
                    [],
                    ['category_id' => $categoryId]
                );
            } catch (ClientException $e) {
                $response = (string)$e->getResponse()->getBody();
                $data = json_decode($response);

                if (current($data->errors)->message = 'The specified category ID must be a leaf category.') {
                    return null;
                }

                throw $e;
            }
        });

        return $response;
    }

    private function getEbaySku(Listing $listing)
    {
        if (App::environment('production')) {
            return 'website-' . $listing->id;
        }

        return App::environment() . '-' . $listing->id;
    }

    public function getInventoryItems()
    {
        return $this->request(
            'get',
            'sell/inventory/v1/inventory_item'
        );
    }

    public function getOffers($sku)
    {
        return $this->request(
            'get',
            'sell/inventory/v1/offer',
            [],
            [
                'sku' => $sku,
                'marketplace_id' => 'EBAY_US',
            ]
        );
    }

    public function deleteInventoryItem($sku)
    {
        return $this->request(
            'delete',
            'sell/inventory/v1/inventory_item/' . $sku,
        );
    }

    public function getTransaction($transactionId)
    {
        $transactions = $this->request(
            'get',
            'sell/finances/v1/transaction',
            [],
            ['filter' => 'transactionId:{' . $transactionId . '}',]
        );

        return current($transactions->transactions);
    }

    public function getOrder($orderId)
    {
        $order = $this->request(
            'get',
            'sell/fulfillment/v1/order/' . $orderId,
        );

        return $order;
    }
}
