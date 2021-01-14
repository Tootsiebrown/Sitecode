<?php

namespace App\Support;

use Laravel\Socialite\SocialiteManager as LaravelSocialiteManager;

class SocialiteManager extends LaravelSocialiteManager
{
    public function createEbayDriver()
    {
        return $this->buildProvider(EbayOAuthProvider::class, config('services.ebay.oauth'));
    }
}
