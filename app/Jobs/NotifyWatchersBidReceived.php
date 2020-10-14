<?php

namespace App\Jobs;

use App\Bid;
use App\Mail\NotifyWatcherBidReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyWatchersBidReceived implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var Bid
     */
    public Bid $bid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->bid->listing->watchers as $watcher) {
            if ($this->bid->user_id === $watcher->id) {
                continue;
            }

            Mail::to($watcher)
                ->queue(new NotifyWatcherBidReceived($this->bid));
        }
    }
}
