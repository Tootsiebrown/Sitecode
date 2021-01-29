<?php

namespace App\Jobs;

use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MarkEbayItemsSold implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $listingId;
    public $quantity;
    public $ebayOrderId;

    /** @var int  */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ebayOrderId, $listingId, $quantity)
    {
        $this->ebayOrderId = $ebayOrderId;
        $this->listingId = $listingId;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::transaction(function () {
            $listing = Listing::withoutGlobalScopes()
                ->find((int)$this->listingId);

            $alreadyAssociatedItems = $listing
                ->itemsForEbayOrder($this->ebayOrderId);

            $remainingQuantityNeeded = $this->quantity - $alreadyAssociatedItems->count();

            if ($remainingQuantityNeeded === 0) {
                return;
            }

            $listingItems = $listing
                ->availableItems()
                ->take($remainingQuantityNeeded);

            DB::table('listing_items')
                ->whereIn('id', $listingItems->pluck('id'))
                ->update(['ebay_order_id' => $this->ebayOrderId]);
        }, 3);
    }
}
