<?php

namespace App\Ebay;

use App\Models\Listing;
use App\Support\TranslatesListingAspects;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use stdClass;

class Sdk
{
    use TranslatesListingAspects;

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

    /**
     * @param string $method
     * @param string $url
     * @param array $json
     * @param array $query
     * @return stdClass
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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
            if ($this->config['log']['general_calls']) {
                Log::info(json_encode($options, JSON_PRETTY_PRINT));
                Log::info($e->getResponse()->getBody()->getContents());
                $e->getResponse()->getBody()->seek(0);
            }

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

    public function createInventoryItem(Listing $listing): bool
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
                'title' => substr($listing->title, 0, 80),
            ],
        ];

        $aspects = $this->getListingAspects($listing, false, true);

        if ($aspects) {
            $data['product']['aspects'] = $aspects;
        }

        if ($listing->upc) {
            $data['product']['upc'] = [$listing->upc];
        }


        $this->request(
            'put',
            'sell/inventory/v1/inventory_item/' . $this->getEbaySku($listing),
            $data,
        );

        return true;
    }

    public function updateInventoryItem(Listing $listing): int
    {
        return $this->createInventoryItem($listing);
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

    public function updateOffer(Listing $listing)
    {
        return $this->request(
            'put',
            'sell/inventory/v1/offer/' . $listing->ebay_offer_id,
            $this->getOfferDataFromListing($listing)
        );
    }

    private function getOfferDataFromListing(Listing $listing)
    {
        $ebayPrice = $listing->price + ($listing->price * $listing->send_to_ebay_markup / 100);
        $data = [
            'availableQuantity' => $listing->availableItems()->count(),
            'categoryId' => $listing->ebay_offer_category_id,
            'format' => 'FIXED_PRICE',
            'includeCatalogProductDescription' => false,
            'listingDescription' => $listing->description
                . ' ' . $listing->features
                . ' ' . $this->getListingDescriptionExtra(),
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

    public function getOrder($orderId)
    {
        return $this->request(
            'get',
            'sell/fulfillment/v1/order/' . $orderId,
        );
    }

    public function getOrders($limit = 10, $offset = 0, Collection $orderIds = null)
    {
        $query = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($orderIds) {
            $query['orderIds'] = $orderIds->implode(',');
        }

        $orders = $this->request(
            'get',
            'sell/fulfillment/v1/order',
            [],
            $query
        );

        return collect($orders->orders);
    }

    /*
     * There's a scope issue here... I don't have permission from the API
     * to do this.
     */
    public function getRecentCancellations()
    {
        return $this->request(
            'get',
            'post-order/v2/cancellation/search',
            [],
            [
                'sort' => '-CANCEL_ID', // descending order
                'limit' => 25,
            ]
        );
    }

    private function getListingDescriptionExtra()
    {
        return 'Thanks for shopping at our store! If you are happy with your purchase- we would appreciate a 5-star rating and positive feedback!

        We answer messages daily - “please allow at least 24 hours for a reply- sometimes it takes us awhile to catch up on our after work hour messages”

        Sorry we DO NOT take offers on our auction listings- We do accept reasonable offers on our buy it now listings

        We list our items fedex, but we ship free and reserve the right to ship USPS or FEDEX, whichever is cheapest according to your location

        If you have a shipping related question/request, please put it in the message box at checkout

        If you need your address changed- please do that during Checkout- once you have purchased, we will not be able to change your address

        You have 4 days to pay after you purchase your item, if payment has not been received an unpaid case will be opened against you. After that we will not be able to cancel on our end

        Visit our store and ❤️this Seller- we list items every weekday';
    }
}
