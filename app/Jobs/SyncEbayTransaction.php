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

class SyncEbayTransaction implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $transactionId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Sdk $ebay)
    {
        $transaction = $ebay->getTransaction($this->transactionId);
        $orderId = $transaction->orderId;
        $order = $ebay->getOrder($orderId);

        $ebayOrder = new EbayOrder([
            'ebay_id' => $orderId,
        ]);
        $ebayOrderId = $ebayOrder->save();

        foreach ($order->lineItems as $orderItem) {
            $quantity = $orderItem->quantity;
            $listingId = $this->getListingId($orderItem->sku);

            MarkEbayItemsSold::dispatch($ebayOrderId, $listingId, $quantity)->onQueue('fast');
        }
    }

    private function getListingId($sku)
    {
        if (App::environment('production')) {
            $env = 'website';
        } else {
            $env = App::environment();
        }

        $env .= '-';

        return substr($sku, strlen($env));
    }
}
