<?php

namespace App\Listeners;

use App\Events\OfferCounterExpiredEvent;
use App\Mail\CounterOfferExpired;
use Illuminate\Support\Facades\Mail;

class SendCounterOfferExpiredNotification
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
     * @param  OfferCounterExpiredEvent  $event
     * @return void
     */
    public function handle(OfferCounterExpiredEvent $event)
    {
        $offer = $event->offer;

        Mail::queue(new CounterOfferExpired($offer));
    }
}
