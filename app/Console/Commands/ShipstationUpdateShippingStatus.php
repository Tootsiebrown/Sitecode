<?php

namespace App\Console\Commands;

use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Services\ShippingService;
use Illuminate\Console\Command;

class ShipstationUpdateShippingStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipstation:update-status {orderId}';

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
        $order = Order::find($this->argument('orderId'));
        $shipstationOrder = $shippingService->getShipstationOrder($order->sequence);

        if ($shipstationOrder->orderStatus === 'shipped') {
            if (is_null($order->default_shipment->shipped_at)) {
                $order->default_shipment->shipped_at = $shipstationOrder->shipDate . ' 00:00:00';
                $order->default_shipment->save();
                $this->info('updated order status');
            }

            if (is_null($order->shipped_at)) {
                $order->shipped_at = $shipstationOrder->shipDate . ' 00:00:00';
                $order->save();
                $this->info('updated shipment status');
            }
        } else {
            $this->info('order hasn\'t shipped');
        }
    }
}
