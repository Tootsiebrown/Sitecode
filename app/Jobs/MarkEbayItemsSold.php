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
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $listingId;
    public $quantity;
    public $ebayOrderId;

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
            $listingItems = Listing::find($this->listingId)->availableItems()->take($this->quantity);

            DB::table('listing_items')->update(['ebay_order_id' => $this->ebayOrderId])
                ->whereIn('id', $listingItems->pluck('id'));
        }, 3);
    }
}
