<?php

namespace App\Support;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;

class EbayOAuthProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = [
        'https://api.ebay.com/oauth/api_scope/sell.inventory'
    ];

    protected function getAuthUrl($state)
    {
        $url = config('services.ebay.oauth.test_mode')
            ? 'https://auth.sandbox.ebay.com/oauth2/authorize'
            : 'https://auth.ebay.com/oauth2/authorize';

        return $this->buildAuthUrlFromBase($url, $state);
    }

    protected function getTokenUrl()
    {
        return config('services.ebay.oauth.test_mode')
            ? 'https://api.sandbox.ebay.com/identity/v1/oauth2/token'
            : 'https://api.ebay.com/identity/v1/oauth2/token';
    }

    protected function getUserByToken($token)
    {
        // TODO: Implement getUserByToken() method.
    }

    protected function mapUserToObject(array $user)
    {
        // TODO: Implement mapUserToObject() method.
    }

    public function getTheCode()
    {
        return $this->request->input('code');
    }

    public function getAccessTokenResponse($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic '. base64_encode($this->clientId . ':' . $this->clientSecret),
            ],
            'form_params' => $this->getTokenFields($code),
        ]);

        return json_decode($response->getBody(), true);
    }
}
