<?php

namespace App\Listeners;

use App\Events\AuctionEndedEvent;
use App\Events\AuctionEndingInOneHourEvent;
use App\Jobs\NotifyWatchersAuctionEnded;
use App\Jobs\NotifyWinner;

class SendAuctionEndingSoonNotification
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
    public function handle(AuctionEndingInOneHourEvent $event)
    {
        $listing = $event->listing;

        NotifyWatchersAuctionEndingSoon::dispatch($listing);
    }
}
