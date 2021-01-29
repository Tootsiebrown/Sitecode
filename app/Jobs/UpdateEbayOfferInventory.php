<?php

namespace App\Jobs;

use App\Ebay\Sdk;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateEbayOfferInventory implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** @var Listing */
    public Listing $listing;

    public int $maxTries = 3;

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
        $ebay->updateInventoryItem(
            $this->listing
        );

        if ($this->listing->ebay_offer_id) {
            $ebay->updateOffer(
                $this->listing
            );
        } else {
            $id = $ebay->createOffer(
                $this->listing
            );

            $this->listing->ebay_offer_id = $id;
            $this->listing->save();
        }
    }
}
