<?php

namespace App\Jobs;

use App\Ebay\Sdk;
use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SyncEbayOrder implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public string $ebayOrderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $ebayOrderId)
    {
        $this->ebayOrderId = $ebayOrderId;
    }

    /**
     * Execute the job.
     *
     * @param Sdk $ebay
     * @return void
     */
    public function handle(Sdk $ebay): void
    {
        $order = $ebay->getOrder($this->ebayOrderId);

        if (! $this->orderHasWebsiteItems($order)) {
            return;
        }

        $ebayOrder = new EbayOrder([
            'ebay_id' => $this->ebayOrderId,
        ]);

        if (config('services.ebay.log.get_order_response')) {
            \Log::channel('single')->info(json_encode($order, JSON_PRETTY_PRINT));
        }

        $ebayOrder->save();

        foreach ($order->lineItems as $orderItem) {
            if (! $this->itemIsFromWebsite($orderItem->sku)) {
                continue;
            }

            $quantity = $orderItem->quantity;
            $listingId = $this->getListingId($orderItem->sku);

            MarkEbayItemsSold::dispatch($ebayOrder->id, $listingId, $quantity)->onQueue('fast');
        }
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

    private function orderHasWebsiteItems($order): bool
    {
        foreach ($order->lineItems as $orderItem) {
            if ($this->itemIsFromWebsite($orderItem->sku)) {
                return true;
            }
        }

        return false;
    }

    public function maxTries()
    {
        return 3;
    }
}
