<?php

namespace App\Console\Commands;

use App\Events\AuctionEndingInOneHourEvent;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;

class ProcessAuctionsEndingInOneHour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:process-ending-soon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process auctions end in one hour';

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
            ::withoutGlobalScopes()
            ->typeIsAuction()
            ->where('expired_at', '>', Carbon::now()->addHour()->toDateTimeString())
            ->where('expired_at', '<=', Carbon::now()->addHour()->addMinute()->toDateTimeString())
            ->get()
            ->each(function ($listing) {
                Event::dispatch(new AuctionEndingInOneHourEvent($listing));
            });
    }
}
