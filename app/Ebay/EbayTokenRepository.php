<?php

namespace App\Ebay;

use App\Models\EbayToken;
use Exception;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Carbon;

class EbayTokenRepository
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function save(
        $accessToken,
        Carbon $accessTokenExpiration,
        $refreshToken,
        Carbon $refreshTokenExpiration
    ) {
        $token = EbayToken::first();

        $data = [
            'access_token' => $accessToken,
            'access_token_expires_at' => $accessTokenExpiration->toDateTimeString(),
            'refresh_token' => $refreshToken,
            'refresh_token_expires_at' => $refreshTokenExpiration->toDateTimeString()
        ];

        if (! $token) {
            $token = new EbayToken($data);
        } else {
            $token->fill($data);
        }

        $token->save();
    }

    public function linkStatus()
    {
        $token = $this->getToken();

        if (!$token) {
            return 'Not Linked';
        } else {
            return 'Linked';
        }
    }

    public function tokenStatus()
    {
        $token = $this->getToken();

        if (!$token) {
            return 'Not Linked';
        }

        if ($token->access_token_expires_at->gte(Carbon::now())) {
            return 'Expires ' . $token->access_token_expires_at->toDateTimeString();
        }

        return 'Expired (not important so long as refresh token is still valid).';
    }

    public function refreshTokenStatus()
    {
        $token = $this->getToken();

        if (!$token) {
            return 'Not Linked';
        }

        if ($token->refresh_token_expires_at->gte(Carbon::now())) {
            return 'Expires ' . $token->refresh_token_expires_at->toDateTimeString();
        }

        return 'Expired';
    }

    public function getToken()
    {
        return EbayToken::first();
    }

    public function isAccessTokenCurrent()
    {
        $token = $this->getToken();

        if (!$token) {
            return false;
        }

        if ($token->access_token_expires_at->lte(Carbon::now())) {
            return false;
        }

        return true;
    }

    public function getAccessToken()
    {
        $token = $this->getToken();

        if (!$token) {
            return null;
        }

        return $token->access_token;
    }

    public function isRefreshTokenCurrent()
    {
        $token = $this->getToken();

        if (!$token) {
            return false;
        }

        if ($token->refresh_token_expires_at->lte(Carbon::now())) {
            return false;
        }

        return true;
    }

    public function refreshAccessToken()
    {
        $token = $this->getToken();

        if (!$token) {
            throw new Exception('Unable to refresh non-existant token');
        }

        $authorizationKey = base64_encode(config('services.ebay.oauth.client_id') . ':' . config('services.ebay.oauth.client_secret'));
        $response = $this->client->request(
            'post',
            'identity/v1/oauth2/token',
            [
                'headers' => [
                    'Authorization' => 'Basic ' . $authorizationKey,
                ],
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $token->refresh_token,
                    'scope' => 'https://api.ebay.com/oauth/api_scope/sell.inventory https://api.ebay.com/oauth/api_scope https://api.ebay.com/oauth/api_scope/sell.account',
                ]
            ]
        );

        $data = json_decode($response->getBody()->getContents());

        $this->saveRefreshedToken(
            $token,
            $data->access_token,
            $data->expires_in
        );
    }

    private function saveRefreshedToken($tokenRecord, $token, $expiresIn)
    {
        $tokenRecord->fill([
            'access_token' => $token,
            'access_token_expires_at' => Carbon::now()->addSeconds($expiresIn)->toDateTimeString(),
        ]);

        $tokenRecord->save();
    }
}
