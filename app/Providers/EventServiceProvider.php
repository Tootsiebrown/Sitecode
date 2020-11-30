<?php

namespace App\Providers;

use App\Events\AuctionEndedEvent;
use App\Events\AuctionEndingInOneHourEvent;
use App\Events\BidReceivedEvent;
use App\Events\OfferCounterExpiredEvent;
use App\Events\OfferExpiredEvent;
use App\Listeners\RestoreOfferInventory;
use App\Listeners\SendAuctionEndedNotification;
use App\Listeners\SendAuctionEndingSoonNotification;
use App\Listeners\SendBidReceivedNotification;
use App\Listeners\SendCounterOfferExpiredNotification;
use App\Listeners\SendOfferExpiredNotification;
use App\Listeners\StartAuctionEndedChain;
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
            StartAuctionEndedChain::class,
        ],
        BidReceivedEvent::class => [
            SendBidReceivedNotification::class,
        ],
        OfferExpiredEvent::class => [
            SendOfferExpiredNotification::class,
            RestoreOfferInventory::class,
        ],
        OfferCounterExpiredEvent::class => [
            SendCounterOfferExpiredNotification::class,
            RestoreOfferInventory::class,
        ],
        AuctionEndingInOneHourEvent::class => [
            SendAuctionEndingSoonNotification::class,
        ],
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
