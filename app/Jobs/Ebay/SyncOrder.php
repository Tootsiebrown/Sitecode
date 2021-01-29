<?php

namespace App\Jobs\Ebay;

use App\Ebay\Sdk;
use App\Jobs\MarkEbayItemsSold;
use App\Models\EbayOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SyncOrder implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 5;

    public string $ebayOrderId;
    public string $transactionId;

    /**
     * Create a new job instance.
     *
     * @param string $ebayOrderId
     * @param string $transactionId
     */
    public function __construct(string $ebayOrderId, string $transactionId)
    {
        $this->ebayOrderId = $ebayOrderId;
        $this->transactionId = $transactionId;
    }

    /**
     * Execute the job.
     *
     * @param Sdk $ebay
     * @return void
     */
    public function handle(Sdk $ebay): void
    {
        $ebayOrder = EbayOrder::firstOrNew(
            ['transaction_id' => $this->transactionId]
        );

        $ebayOrder->ebay_id = $this->ebayOrderId;

        $order = $ebay->getOrder($this->ebayOrderId);

        if (config('services.ebay.log.get_order_response')) {
            Log::channel('single')->info(json_encode($order, JSON_PRETTY_PRINT));
        }

        if (! $this->orderHasWebsiteItems($order)) {
            return;
        }

        try {
            $ebayOrder->save();
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                // duplicate order for some reason. just go ahead and quit here
                // no need to fail which will just result in this being repeated a lot
                Log::info(
                    'duplicate order '
                    . $this->ebayOrderId
                    . ' for transaction '
                    . $this->transactionId
                );

                $this->fail($e);
            }

            throw $e;
        }

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
            if (!isset($orderItem->sku)) {
                continue;
            }
            
            if ($this->itemIsFromWebsite($orderItem->sku)) {
                return true;
            }
        }

        return false;
    }
}
