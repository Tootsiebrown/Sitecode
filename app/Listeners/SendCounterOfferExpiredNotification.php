<?php

namespace App\Listeners;

use App\Events\OfferExpiredEvent;
use App\Mail\CounterOfferExpired;
use App\Mail\OfferExpired;
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
     * @param  OfferExpiredEvent  $event
     * @return void
     */
    public function handle(OfferExpiredEvent $event)
    {
        $offer = $event->offer;

        Mail::queue(new CounterOfferExpired($offer));
    }
}
