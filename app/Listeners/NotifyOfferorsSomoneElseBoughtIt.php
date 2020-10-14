<?php

namespace App\Listeners;

Use App\Jobs\NotifyOfferorsSomeoneElseBoughtIt as NotifyOfferorsSomeoneElseBoughtItJob;
use Wax\Shop\Events\OrderPlacedEvent;

class NotifyOfferorsSomoneElseBoughtIt
{
    public function handle(OrderPlacedEvent $event)
    {
        NotifyOfferorsSomeoneElseBoughtItJob::dispatch($event->order());
    }
}
