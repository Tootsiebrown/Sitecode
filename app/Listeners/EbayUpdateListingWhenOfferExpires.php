<?php

namespace App\Listeners;

use App\Events\OfferExpiredEvent;
use App\Jobs\UpdateEbayOfferInventory;

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
        if ($event->offer->listing->sent_to_ebay_at) {
            UpdateEbayOfferInventory::dispatch($event->offer->listing);
        }
    }
}
