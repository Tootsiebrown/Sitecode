<?php

namespace App\Listeners;

use App\Events\AuctionEndedEvent;
use App\Jobs\NotifyWinner;

class SendAuctionEndedNotification
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
     * @param  AuctionEndedEvent  $event
     * @return void
     */
    public function handle(AuctionEndedEvent $event)
    {
        $listing = $event->listing;

        NotifyWinner::dispatch($listing);
    }
}
