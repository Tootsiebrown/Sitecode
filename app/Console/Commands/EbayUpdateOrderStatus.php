<?php

namespace App\Console\Commands;

use App\Ebay\Sdk;
use App\Models\EbayOrder;
use Illuminate\Console\Command;

class EbayUpdateOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ebay:update-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update orders to show canceled and shipped';

    /** @var Sdk */
    private Sdk $ebay;

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
        $this->ebay = $ebay;
        $this->updateShippedStatus();
    }

    private function updateShippedStatus()
    {
        $ordersToCheck = EbayOrder::whereNull('shipped_at')
            ->whereNull('canceled_at')
            ->whereNotNull('ebay_id')
            ->take(50)
            ->get()
            ->pluck('ebay_id');

        $orders = $this->ebay->getOrders(50, 0, $ordersToCheck);

        dd($orders);
    }
}
