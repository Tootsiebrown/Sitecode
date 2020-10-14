<?php

namespace App\Console\Commands;

use App\Events\AuctionEndedEvent;
use App\Events\OfferCounterExpiredEvent;
use App\Events\OfferExpiredEvent;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;

class ProcessExpiredOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer:process-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process auctions that have ended';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Offer::expirationEventNotFired()
            ->status('expired')
            ->get()
            ->each(function ($offer) {
                $offer->expired_event_fired = true;
                $offer->save();
                Event::dispatch(new OfferExpiredEvent($offer));
            });

        Offer::expirationEventNotFired()
            ->status('counter_expired')
            ->get()
            ->each(function ($offer) {
                $offer->expired_event_fired = true;
                $offer->save();
                Event::dispatch(new OfferCounterExpiredEvent($offer));
            });
    }
}
