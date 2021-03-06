<?php

namespace App\Jobs;

use App\Mail\NotifyWatcherAuctionEnded;
use App\Mail\NotifyWatcherAuctionEndingSoon;
use App\Mail\NotifyWinner as NotifyWinnerEmail;
use App\Mail\NotifyNoWinner as NotifyNoWinnerEmail;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Wax\Core\Support\ConfigurationDatabase;

class NotifyWatchersAuctionEndingSoon implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

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
        foreach ($this->listing->watchers as $watcher) {
            Mail::to($watcher)
                ->queue(new NotifyWatcherAuctionEndingSoon($this->listing));
        }
    }
}
