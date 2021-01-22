<?php

namespace App\Jobs\Ebay;

use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SyncPendingTransaction implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;

    public string $transactionId;
    public string $sku;
    public int $quantity;

    /**
     * Create a new job instance.
     *
     * @param string $transactionId
     * @param string $sku
     * @param int $quantity
     */
    public function __construct(string $transactionId, string $sku, int $quantity)
    {
        $this->transactionId = $transactionId;
        $this->sku = $sku;
        $this->quantity = $quantity;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! $this->itemIsFromWebsite($this->sku)) {
            return;
        }

        $ebayOrder = EbayOrder::firstOrCreate(['transaction_id' => $this->transactionId]);

        DB::transaction(function () use ($ebayOrder) {
            $listingItems = Listing::find($this->getListingId($this->sku))
                ->availableItems()
                ->take($this->quantity);

            DB::table('listing_items')
                ->whereIn('id', $listingItems->pluck('id'))
                ->update(['ebay_order_id' => $ebayOrder->id]);
        }, 3);
    }

    private function getListingId($sku): string
    {
        $env = $this->getEnvPrefix();

        return substr($sku, strlen($env));
    }

    private function itemIsFromWebsite($sku): bool
    {
        $index = strpos(
            $sku,
            $this->getEnvPrefix()
        );

        return $index === 0;
    }

    private function getEnvPrefix(): string
    {
        if (App::environment('production')) {
            $env = 'website';
        } else {
            $env = App::environment();
        }

        $env .= '-';

        return $env;
    }
}
