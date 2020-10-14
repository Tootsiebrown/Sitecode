<?php

namespace App\Listeners;

use App\Events\OfferExpiredEvent;
use App\Jobs\RestoreOfferInventory as RestoreOfferInventoryJob;

class RestoreOfferInventory
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
        $offer = $event->offer;

        RestoreOfferInventoryJob::dispatch($offer);
    }
}
