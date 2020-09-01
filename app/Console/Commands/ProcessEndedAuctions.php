<?php

namespace App\Console\Commands;

use App\Events\AuctionEndedEvent;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;

class ProcessEndedAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:process-ended';

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
        Listing
            ::expired()
            ->typeIsAuction()
            ->endEventNotFired()
            ->get()
            ->each(function ($listing) {
                $listing->end_event_fired = true;
                $listing->save();
                Event::dispatch(new AuctionEndedEvent($listing));
            });
    }
}
