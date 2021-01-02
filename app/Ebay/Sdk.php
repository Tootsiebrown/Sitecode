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
use Illuminate\Support\Facades\Cache;

class Sdk
{
    private string $server;
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
            || empty($ebayConfig['api_token'])
            || empty($ebayConfig['app_id'])
        ) {
            throw new Exception('eBay SDK not properly configured');
        }

        if (! $ebayConfig['managed_payments'] && empty($ebayConfig['paypal_email'])) {
            throw new Exception('eBay SDK not properly configured for payments');
        }

        $this->server = $ebayConfig['test_mode']
            ? "https://api.sandbox.ebay.com"
            : "https://api.ebay.com";

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



    public function getCategories(int $parentId = null, $levelLimit = null)
    {
        $treeVersion = $this->getCategoryTreeVersion();

        dd($treeVersion);
        $request = new GetCategories();

        if (is_null($levelLimit)) {
            $request->setLevelLimit(1);
        } else {
            $request->setLevelLimit($levelLimit);
        }

        if ($parentId) {
            $request->setCategoryParent($parentId);
        }

        $response = $this->sendRequest('getCategories', $request);

        if (is_array($response->CategoryArray->Category)) {
            return collect($response->CategoryArray->Category);
        } else {
            return collect($response->CategoryArray);
        }
    }

    private function getCategoryTreeVersion()
    {
        return Cache::remember(
            'ebay-category-tree-version',
            1, //Carbon::now()->addHours(24),
            function () {
                return $this->request(
                    'get',
                    'commerce/taxonomy/v1/get_default_category_tree_id',
                    null,
                    ['marketplace_id' => 'EBAY_US'],
                );
            }
        );
    }

    private function request($method, $url, $json = [], $query = [])
    {
        $accessToken = $this->getCurrentAccessToken();

        $options = [
            'headers' => [
                'Authorization' => 'Bearer :' . $accessToken
            ]
        ];

        if ($json) {
            $options['json'] = $json;
        }

        if ($query) {
            $options['query'] = $query;
        }

        $response = $this->client->request(
            $method,
            $url,
            $options
        );

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

    public function newListing(Listing $listing): int
    {
        $ebayPrice = $listing->price * (1 + $listing->send_to_ebay_markup/100);

        $request = new AddFixedPriceItem();
        $request->setConditionId($listing->ebay_condition_id);
        $request->setConditionDescription($listing->condition);
        $request->setDescription($listing->description . ' ' . strip_tags($listing->features));
        $request->setPrimaryCategoryId($listing->ebay_primary_category_id);
        $request->setPrice($ebayPrice); // increase price
        $request->setPostalCode($this->config['item_postal_code']);
        $request->setQuantity($listing->availableItems()->count());
        $request->setTitle($listing->title);

        if (!$this->config['managed_payments']) {
            $request->setPaymentMethods($this->config['paypal_email']);
        }

        if (!$this->config['shipping_profile']) {
            $request->setShippingDetails(
                $this->getCustomShippingCost($ebayPrice),
                $this->getCustomShippingCost($ebayPrice*2),
            );
        }

        $response = $this->sendRequest('addFixedPriceItem', $request);

        if ($this->shouldLogResponse($response)) {
            $this->logRequest($request);
            $this->logResponse($response);
        }

        if ($this->responseSomewhatSuccessful($response)) {
            if ($response->ItemID) {
                return $response->ItemID;
            }
        }

        throw new Exception('Ebay API failure. See logs messages above.');
    }

    public function getCustomShippingCost($price)
    {
        foreach (config('shipping.custom_shipping_tiers') as $orderCost => $shippingCost) {
            if ($price >= $orderCost) {
                return $shippingCost;
            }
        }
    }

    public function getEbayDetails(...$details)
    {
        $request = new GetEbayDetails();

        if ($details) {
            $request->setDetails($details);
        }

        $response = $this->sendRequest('geteBayDetails', $request);

        dd($response);
    }

    public function getEbayCategoryFeatures($categoryId, $features = [])
    {
        $request = new GetCategoryFeatures();

        if ($categoryId) {
            $request->setCategoryId($categoryId);
        }

        if (!empty($features)) {
            $request->setFeatures($features);
        }

        $response = $this->sendRequest('getCategoryFeatures', $request);

        return $response;
    }

//    public function sendRequest($method, $request)
//    {
//        $client = new SoapClient(
//            base_path() . "/resources/ebay/eBaySvc.wsdl",
//            [
//                'cache_wsdl' => WSDL_CACHE_MEMORY,
//                'keep_alive' => false,
//                'location' => $this->buildRequestUrl($method)
//            ]
//        );
//
//        $requesterCredentials = new \stdClass();
//        $requesterCredentials->eBayAuthToken = $this->config['api_token'];
//
//        $header = new SoapHeader('urn:ebay:apis:eBLBaseComponents', 'RequesterCredentials', $requesterCredentials);
//
//        $request->setVersion($this->config['api_version']);
//
//        try {
//            return $client->__soapCall($method, $request->toArray(), null, $header);
//        } catch (SoapFault $e) {
//            throw new Exception('ebay API not available', 0, $e);
//        }
//    }
//
//    protected function buildRequestUrl(string $method)
//    {
//        return $this->server . '?' . http_build_query(
//            [
//                'callname' => $method,
//                'appid' => $this->config['app_id'],
//                'siteid' => 0,
//                'version' => $this->config['api_version'],
//                'routing' => 'new',
//            ]
//        );
//    }
//
//    protected function shouldLogResponse($response)
//    {
//        return $response->Ack !== "Success";
//    }
//
//    protected function logRequest(AbstractRequest $request)
//    {
//        Log::info((string) $request);
//    }
//
//    protected function logResponse($response)
//    {
//        Log::info(print_r($response,1));
//    }
//
//    protected function responseSomewhatSuccessful($response)
//    {
//        return $response->Ack !== "Failure";
//    }
}
