<?php

namespace App\Providers;

use App\Events\AuctionEndedEvent;
use App\Events\OfferCounterExpiredEvent;
use App\Events\OfferExpiredEvent;
use App\Listeners\SendAuctionEndedNotification;
use App\Listeners\SendCounterOfferExpiredNotification;
use App\Listeners\SendOfferExpiredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AuctionEndedEvent::class => [
            SendAuctionEndedNotification::class,
        ],
        OfferExpiredEvent::class => [
            SendOfferExpiredNotification::class,
            RestoreOfferInventory::class,
        ],
        OfferCounterExpiredEvent::class => [
            SendCounterOfferExpiredNotification::class,
            RestoreOfferInventory::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
