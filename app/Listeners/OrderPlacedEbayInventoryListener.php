<?php

namespace App\Listeners;

use App\Jobs\UpdateEbayOfferInventory;
use Illuminate\Support\Facades\Queue;
use Wax\Shop\Events\OrderPlacedEvent;

class OrderPlacedEbayInventoryListener
{
    public function handle(OrderPlacedEvent $event)
    {
        $event
            ->order()
            ->items
            ->each(function ($item) {
                if ($item->listing->ebay_offer_id) {
                    Queue::push(new UpdateEbayOfferInventory($item->listing));
                }
            });
    }
}
