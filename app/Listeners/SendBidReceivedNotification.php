<?php

namespace App\Listeners;

use App\Events\BidReceivedEvent;

class SendBidReceivedNotification
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
     * @param  BidReceivedEvent  $event
     * @return void
     */
    public function handle(BidReceivedEvent $event)
    {
        $bid = $event->bid;

        NotifyWatchersBidReceived::dispatch($bid);
    }
}
