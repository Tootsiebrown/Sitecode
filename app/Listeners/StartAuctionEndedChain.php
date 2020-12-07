<?php

namespace App\Listeners;

use App\Events\AuctionEndedEvent;
use App\Jobs\NotifyWatchersAuctionEnded;
use App\Jobs\NotifyWinner;
use App\Models\EndedAuction;

class StartAuctionEndedChain
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

        if (! $listing->winner) {
            return;
        }

        $endedAuction = new EndedAuction([
            'listing_id' => $listing->id,
        ]);

        $endedAuction->save();
    }
}
