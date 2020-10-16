<?php

namespace App\Listeners;

use App\Jobs\UpdateStripeOrderId as UpdateStripeOrderIdJob;
use Wax\Shop\Events\OrderPlacedEvent;

class UpdateStripeOrderId
{
    public function handle(OrderPlacedEvent $event)
    {
        UpdateStripeOrderIdJob::dispatch($event->order());
    }
}
