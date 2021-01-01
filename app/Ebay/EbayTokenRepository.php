<?php

namespace App\Ebay;

use App\Models\EbayToken;
use Illuminate\Support\Carbon;

class EbayTokenRepository
{
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
}
