<?php

namespace App\Listeners;

use App\Jobs\NotifyOfferorsSomeoneElseBoughtIt as NotifyOfferorsSomeoneElseBoughtItJob;
use Wax\Shop\Events\OrderPlacedEvent;

class NotifyOfferorsSomeoneElseBoughtIt
{
    public function handle(OrderPlacedEvent $event)
    {
        NotifyOfferorsSomeoneElseBoughtItJob::dispatch($event->order());
    }
}
