<?php


namespace App\Wax\Shop\Providers;

use Illuminate\Database\Eloquent\Model;
use Wax\Core\Contracts\FilterAggregatorContract;
use Wax\Shop\Filters\CatalogFilterAggregator;
use Wax\Shop\Providers\ShopServiceProvider as WaxShopServiceProvider;
use Wax\Shop\Repositories\ProductRepository;
use Wax\Shop\Services\ShopService;

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
    }

    public function boot ()
    {
        $this->registerConsoleCommands();

        $this->loadViewsFrom(base_path('vendor/oohology/wax-shop/resources/views/'), 'shop');
        $this->loadTranslationsFrom(base_path('vendor/oohology/wax-shop/resources/lang'), 'shop');
    }
}
