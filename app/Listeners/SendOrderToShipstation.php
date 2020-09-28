<?php

namespace App\Listeners;

use App\Jobs\OrderToShipstation;
use App\Wax\Shop\Services\ShippingService;
use Wax\Shop\Events\OrderPlacedEvent;

class SendOrderToShipstation
{
    public function handle(OrderPlacedEvent $event)
    {
        OrderToShipstation::dispatch($event->order());
    }
}
