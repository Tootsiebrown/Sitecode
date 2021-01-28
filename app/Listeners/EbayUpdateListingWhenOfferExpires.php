<?php

namespace App\Listeners;

use App\Events\OfferExpiredEvent;
use App\Jobs\UpdateEbayOfferInventory;
use App\Mail\OfferExpired;
use Illuminate\Support\Facades\Mail;

class EbayUpdateListingWhenOfferExpires
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OfferExpiredEvent  $event
     * @return void
     */
    public function handle(OfferExpiredEvent $event)
    {
        UpdateEbayOfferInventory::dispatch($event->offer->listing);
    }
}
