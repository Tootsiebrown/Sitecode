<?php

namespace App\Listeners;

use App\Jobs\SetAuctionPurchased;
use Wax\Shop\Events\OrderPlacedEvent;

class AuctionPurchasedListener
{
    public function handle(OrderPlacedEvent $event)
    {
        $order = $event->order();
        foreach ($order->items as $item) {
            if ($item->listing->is_auction) {
                SetAuctionPurchased::dispatch($item->listing);
            }
        }
    }
}
