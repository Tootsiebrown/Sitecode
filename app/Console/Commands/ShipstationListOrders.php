<?php

namespace App\Console\Commands;

use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Services\ShippingService;
use Illuminate\Console\Command;

class ShipstationListOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipstation:list-orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check whether an order has shipped and update it\'s status';

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
     * @param ShippingService $shippingService
     */
    public function handle(ShippingService $shippingService)
    {
        $orders = $shippingService->getAllShipstationOrders();

        dd($orders);
    }
}
