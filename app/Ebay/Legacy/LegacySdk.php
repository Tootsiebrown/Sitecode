<?php

namespace App\Ebay\Legacy;

use App\Ebay\Legacy\Requests\AbstractRequest;
use App\Ebay\Legacy\Requests\GetNotificationPreferences;
use App\Ebay\Legacy\Requests\SetNotificationPreferences;
use Exception;
use SoapClient;
use SoapFault;
use SoapHeader;

class LegacySdk
{
    private string $server;
    private array $config;

    public function __construct()
    {
        $ebayConfig = config('services.ebay.legacy');
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

    public function getNotificationPreferences(string $preferenceLevel = 'User')
    {
        $request = new GetNotificationPreferences();

        $request->setPreferenceLevel($preferenceLevel);

        return $this->sendRequest('getNotificationPreferences', $request);
    }

    public function setNotificationPreferences(string $type, bool $subscribed)
    {
        $request = new SetNotificationPreferences();

        switch ($type) {
            case 'checkout':
                $request->setCheckoutSubscription($subscribed);
                break;
            case 'transaction':
                $request->setTransactionSubscription($subscribed);
                break;
            default:
                throw new Exception('Subscription of type ' . $type . ' is not implemented.');
        }

        return $this->sendRequest('setNotificationPreferences', $request);
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
