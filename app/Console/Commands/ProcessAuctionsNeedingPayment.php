<?php

namespace App\Console\Commands;

use App\Events\AuctionEndingInOneHourEvent;
use App\Mail\NotifyWinnerPaymentNeeded;
use App\Models\EndedAuction;
use App\Models\Listing;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

class ProcessAuctionsNeedingPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:process-needing-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process auctions that ended 12 hours ago and need payment';

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
        $remindableAuctions = EndedAuction::whereNull('purchased_at')
            ->whereNull('reminder_sent_at')
            ->where('created_at', '<', Carbon::now()->subHours(12)->toDateTimeString())
            ->get();

        $bar = $this->output->createProgressBar(count($remindableAuctions));
        $bar->start();

        foreach($remindableAuctions as $remindable) {
            $listing = $remindable->listing;

            Mail::to($listing->winner)
                ->queue(new NotifyWinnerPaymentNeeded($listing));

            $remindable->reminder_sent_at = Carbon::now()->toDateTimeString();
            $remindable->save();

            $bar->advance();
        }

        $bar->finish();
    }
}
