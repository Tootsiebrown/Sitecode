<?php

namespace App\Listeners;

use App\Events\AuctionEndedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        //
    }
}
