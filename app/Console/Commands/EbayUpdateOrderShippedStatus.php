<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use App\Jobs\EbayMarkOrderShipped;
use App\Models\EbayOrder;
use Illuminate\Console\Command;

class EbayUpdateOrderShippedStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:update-order-shipped-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update orders that shipped';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @param Sdk $ebay
     */
    public function handle(Sdk $ebay)
    {
        $ordersToCheck = EbayOrder::whereNull('shipped_at')
            ->whereNull('canceled_at')
            ->whereNotNull('ebay_id')
            ->orderBy('updated_at', 'desc')
            ->take(100)
            ->get()
            ->pluck('ebay_id')
            ->chunk(50);

        $ordersToCheck
            ->each(function ($orderChunk) use ($ebay) {
                $ebay
                    ->getOrders(50, 0, $orderChunk)
                    ->each(function ($order) {
                        if ($order->orderFulfillmentStatus === 'FULFILLED') {
                            EbayMarkOrderShipped::dispatch($order->orderId);
                        }
                    });
            });
    }
}
