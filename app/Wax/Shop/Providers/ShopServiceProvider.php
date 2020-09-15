<?php

namespace App\Wax\Shop\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Wax\Core\Contracts\FilterAggregatorContract;
use Wax\Shop\Filters\CatalogFilterAggregator;
use Wax\Shop\Providers\ShopServiceProvider as WaxShopServiceProvider;
use Wax\Shop\Repositories\ProductRepository;
use Wax\Shop\Services\ShopService;
use Wax\Shop\Tax\Contracts\TaxDriverContract;

class ShopServiceProvider extends WaxShopServiceProvider
{
    public function register()
    {
        $this->registerConfig();

        // for the ShopServiceFacade
        $this->app->bind('shop.service', ShopService::class);

        $this->app->when(ProductRepository::class)
            ->needs(Model::class)
            ->give(config('wax.shop.models.product'));

        $this->app->when(ProductRepository::class)
            ->needs(FilterAggregatorContract::class)
            ->give(CatalogFilterAggregator::class);

        $this->app->bind(
            TaxDriverContract::class,
            function ($app) {
                return $app->make(config('wax.shop.tax.driver'));
            }
        );
    }

    public function boot()
    {
        $this->registerConsoleCommands();

        $this->loadViewsFrom(base_path('vendor/oohology/wax-shop/resources/views/'), 'shop');
        $this->loadTranslationsFrom(base_path('vendor/oohology/wax-shop/resources/lang'), 'shop');

        Gate::define('get-order', 'Wax\Shop\Policies\OrderPolicy@get');
    }
}
