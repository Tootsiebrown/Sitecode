<?php

namespace App\Jobs;

use App\Mail\NotifyWatcherAuctionEnded;
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

class NotifyWatchersAuctionEnded implements ShouldQueue
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
        $winnerId = $this->listing->winner
            ? $this->listing->winner->id
            : null;

        foreach($this->listing->watchers as $watcher) {
            if ($winnerId === $watcher->id) {
                continue;
            }

            Mail::to($watcher)
                ->queue(new NotifyWatcherAuctionEnded($this->listing));
        }
    }
}
