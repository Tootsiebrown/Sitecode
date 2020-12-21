<?php

namespace App\Ebay;

use App\Ebay\Requests\AddFixedPriceItem;
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

        $this->server = $ebayConfig['test_mode']
            ? "https://api.sandbox.ebay.com/wsapi"
            : "https://api.ebay.com/wsapi";

        $this->config = $ebayConfig;
    }

    public function newListing(Listing $listing): int
    {
        $request = new AddFixedPriceItem();

        $response = $this->sendRequest('addFixedPriceItem', $request);

        dd($response);

        return 1;
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
            dump($client->__getLastRequest());
            dd($e);
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
