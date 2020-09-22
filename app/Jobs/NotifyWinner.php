<?php

namespace App\Jobs;

use App\Events\AuctionEndedEvent;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Wax\Core\Support\ConfigurationDatabase;

class NotifyWinner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Listing
     */
    public Listing $listing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->listing->winner) {
            Mail::to($this->listing->winner)
                ->queue(NotifyWinnerEmail::class);
        } else {
            $siteSettings = new ConfigurationDatabase('Site Settings');
            Mail::to($siteSettings->get('DEV_EMAIL_ALERT'))
                ->queue(NotifyNoWinnerEmail::class);
        }
    }
}
