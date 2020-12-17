<?php

namespace App\Console\Commands;

use App\Events\AuctionEndedEvent;
use App\Events\OfferCounterExpiredEvent;
use App\Events\OfferExpiredEvent;
use App\Jobs\SendListingToEbay;
use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class ProcessListingsToEbay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:process-ready-listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process listings that need to go to ebay';

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
        Listing::readyForEbay()
            ->get()
            ->each(function ($listing) {
                SendListingToEbay::dispatch($listing);
            });
    }
}
