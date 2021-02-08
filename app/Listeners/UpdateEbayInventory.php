<?php

namespace App\Listeners;

use App\Events\InventoryChangedEvent;
use App\Jobs\UpdateEbayOfferInventory;

class UpdateEbayInventory
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
     * @param  InventoryChangedEvent  $event
     * @return void
     */
    public function handle(InventoryChangedEvent $event)
    {
        UpdateEbayOfferInventory::dispatch($event->listing);
    }
}
