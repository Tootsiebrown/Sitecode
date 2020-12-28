<?php

namespace App\Ebay;

use App\Ebay\Requests\AddFixedPriceItem;
use App\Ebay\Requests\GetCategories;
use App\Ebay\Requests\GetEbayDetails;
use App\Models\Listing;
use Exception;
use SoapClient;
use SoapFault;
use SoapHeader;

class Sdk
{
    private string $server;
    private array $config;

    public function __construct()
    {
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
            ? "https://api.sandbox.ebay.com/wsapi"
            : "https://api.ebay.com/wsapi";

        $this->config = $ebayConfig;
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

        dd($response);

        return 1;
    }

    public function getCustomShippingCost($price)
    {
        foreach (config('shipping.custom_shipping_tiers') as $orderCost => $shippingCost) {
            if ($price >= $orderCost) {
                return $shippingCost;
            }
        }
    }

    public function getCategories(int $parentId = null, $levelLimit = null)
    {
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

    public function getEbayDetails(...$details)
    {
        $request = new GetEbayDetails();

        if ($details) {
            $request->setDetails($details);
        }

        $response = $this->sendRequest('geteBayDetails', $request);

        dd($response);
    }

    public function sendRequest($method, $request)
    {
        $client = new SoapClient(
            base_path() . "/resources/ebay/eBaySvc.wsdl",
            [
                'cache_wsdl' => WSDL_CACHE_MEMORY,
                'keep_alive' => false,
                'location' => $this->buildRequestUrl($method)
            ]
        );

        $requesterCredentials = new \stdClass();
        $requesterCredentials->eBayAuthToken = $this->config['api_token'];

        $header = new SoapHeader('urn:ebay:apis:eBLBaseComponents', 'RequesterCredentials', $requesterCredentials);

        $request->setVersion($this->config['api_version']);

        try {
            return $client->__soapCall($method, $request->toArray(), null, $header);
        } catch (SoapFault $e) {
            throw new Exception('ebay API not available', 0, $e);
        }
    }

    protected function buildRequestUrl(string $method)
    {
        return $this->server . '?' . http_build_query(
            [
                'callname' => $method,
                'appid' => $this->config['app_id'],
                'siteid' => 0,
                'version' => $this->config['api_version'],
                'routing' => 'new',
            ]
        );
    }
}
