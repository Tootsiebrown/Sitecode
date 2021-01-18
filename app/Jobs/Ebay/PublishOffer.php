<?php

namespace App\Jobs\Ebay;

use App\Ebay\Sdk;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PublishOffer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** @var Listing */
    private Listing $listing;

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
    public function handle(Sdk $ebay)
    {
        try {
            $listingId = $ebay->publishOffer($this->listing->ebay_offer_id);

            $this->listing->ebay_listing_id = $listingId;
            $this->listing->save();
        } catch (\Exception $e) {
            $this->listing->to_ebay_error_at = Carbon::now()->toDateTimeString();
            $this->listing->save();
            throw $e;
        }
    }

    public function maxTries()
    {
        return 3;
    }
}
