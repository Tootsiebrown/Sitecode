<?php

namespace App\Jobs;

use App\Models\EndedAuction;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SetAuctionPurchased implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** @var Listing */
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
        $endedAuction = EndedAuction::where('listing_id', $this->listing->id)->first();

        if (! $endedAuction) {
            return;
        }

        $endedAuction->purchased_at = Carbon::now()->toDateTimeString();
        $endedAuction->save();
    }
}
