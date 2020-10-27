<?php

namespace App\Wax\Shop\Providers;

use App\Wax\Shop\Models\Order\Item;
use App\Wax\Shop\Validators\OrderItemValidator;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use LaravelShipStation\ShipStation;
use Stripe\StripeClient;
use Wax\Core\Contracts\FilterAggregatorContract;
use Wax\Core\Events\SessionMigrationEvent;
use Wax\Shop\Contracts\OrderChangedEventContract;
use Wax\Shop\Events\OrderChanged\CartContentsChangedEvent;
use Wax\Shop\Events\OrderChanged\ShippingAddressChangedEvent;
use Wax\Shop\Events\OrderChanged\ShippingServiceChangedEvent;
use Wax\Shop\Events\OrderPlacedEvent;
use Wax\Shop\Filters\CatalogFilterAggregator;
use Wax\Shop\Listeners\InvalidateOrderShippingListener;
use Wax\Shop\Listeners\InvalidateOrderTaxListener;
use Wax\Shop\Listeners\LoginListener;
use Wax\Shop\Listeners\RecalculateDiscountsListener;
use Wax\Shop\Listeners\SessionMigrationListener;
use Wax\Shop\Models\Order\Bundle;
use Wax\Shop\Models\User\PaymentMethod;
use Wax\Shop\Observers\OrderBundleObserver;
use Wax\Shop\Observers\OrderItemObserver;
use Wax\Shop\Policies\PaymentMethodPolicy;
use Wax\Shop\Providers\ShopServiceProvider as WaxShopServiceProvider;
use Wax\Shop\Repositories\ProductRepository;
use Wax\Shop\Services\ShopService;
use Wax\Shop\Tax\Contracts\TaxDriverContract;
use Wax\Shop\Validators\OrderItemValidator as WaxOrderItemValidator;

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

        $this->app->bind(
            WaxOrderItemValidator::class,
            OrderItemValidator::class
        );

        $this->app->bind(
            ShipStation::class,
            function ($app) {
                return new ShipStation(
                    config('services.ship_station.api_key'),
                    config('services.ship_station.api_secret'),
                    config('services.ship_station.api_url')
                );
            }
        );

        $this->app->bind(
            StripeClient::class,
            function ($app) {
                return new StripeClient(
                    config('wax.shop.payment.drivers.stripe.secret_key')
                );
            }
        );
    }

    public function boot()
    {
        $this->registerConsoleCommands();

        $this->loadViewsFrom(base_path('vendor/oohology/wax-shop/resources/views/'), 'shop');
        $this->loadTranslationsFrom(base_path('vendor/oohology/wax-shop/resources/lang'), 'shop');

        Gate::define('get-order', 'App\Wax\Shop\Policies\OrderPolicy@get');
        $this->registerPolicies();

        $this->registerListeners();
    }

    public function registerListeners()
    {
        // clean up the nested relations when an Order Item changes
        Item::observe(OrderItemObserver::class);
        Bundle::observe(OrderBundleObserver::class);

        Event::listen(SessionMigrationEvent::class, SessionMigrationListener::class);
        Event::listen(Login::class, LoginListener::class);

        Event::listen(
            [
                CartContentsChangedEvent::class,
                ShippingAddressChangedEvent::class,
            ],
            InvalidateOrderShippingListener::class
        );

        Event::listen(
            [
                CartContentsChangedEvent::class,
                ShippingServiceChangedEvent::class,
            ],
            RecalculateDiscountsListener::class
        );

        Event::listen(OrderChangedEventContract::class, InvalidateOrderTaxListener::class);

        foreach (config('wax.shop.listeners.place_order') as $listener) {
            Event::listen(OrderPlacedEvent::class, $listener);
        }
    }
}
