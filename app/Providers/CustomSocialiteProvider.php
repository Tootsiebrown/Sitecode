<?php

namespace App\Providers;

use App\Support\SocialiteManager;
use Laravel\Socialite\SocialiteServiceProvider;

class CustomSocialiteProvider extends SocialiteServiceProvider
{
    public function register()
    {
        $this->app->singleton('Laravel\Socialite\Contracts\Factory', function ($app) {
            return new SocialiteManager($app);
        });
    }
}
