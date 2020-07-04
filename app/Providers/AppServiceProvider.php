<?php

namespace App\Providers;

use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        load_options();

        view()->composer('*', function ($view) {
            $enable_monetize = get_option('enable_monetize');
            $loggedUser = null;
            if (Auth::check()) {
                $loggedUser = Auth::user();
            }

            $current_lang = current_language();

            $view->with(['lUser' => $loggedUser, 'enable_monetize' => $enable_monetize, 'current_lang' => $current_lang]);
        });
    }
}
