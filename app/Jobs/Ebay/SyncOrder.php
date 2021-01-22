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

    public string $ebayOrderId;
    /** @var false */
    private bool $sync;

    /** @var int  */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * @param string $ebayOrderId
     * @param bool $sync
     */
    public function __construct(string $ebayOrderId, bool $sync = false)
    {
        $this->ebayOrderId = $ebayOrderId;
        $this->sync = $sync;
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

        if (config('services.ebay.log.get_order_response')) {
            Log::channel('single')->info(json_encode($order, JSON_PRETTY_PRINT));
        }

        if (! $this->orderHasWebsiteItems($order)) {
            return;
        }

        $ebayOrder = new EbayOrder([
            'ebay_id' => $this->ebayOrderId,
        ]);

        try {
            $ebayOrder->save();
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                // duplicate order for some reason. just go ahead and quite here
                // no need to fail which will just result in this being repeated a lot
                Log::info('duplicate order ' . $this->ebayOrderId);
                return;
            }

            throw $e;
        }

        foreach ($order->lineItems as $orderItem) {
            if (! $this->itemIsFromWebsite($orderItem->sku)) {
                continue;
            }

            $quantity = $orderItem->quantity;
            $listingId = $this->getListingId($orderItem->sku);

            if ($this->sync) {
                $job = new MarkEbayItemsSold($ebayOrder->id, $listingId, $quantity);
                $job->handle();
            } else {
                MarkEbayItemsSold::dispatch($ebayOrder->id, $listingId, $quantity)->onQueue('fast');
            }
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
}
