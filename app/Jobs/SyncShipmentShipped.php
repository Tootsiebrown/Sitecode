<?php

namespace App\Jobs;

use App\Wax\Shop\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use LaravelShipStation\ShipStation;

class SyncShipmentShipped implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $vars;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($vars)
    {
        $this->vars = $vars;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ShipStation $shipStation)
    {
        $info = $shipStation->shipments->get($this->vars);

        $orderKeys = [];

        foreach ($info->shipments as $shipment) {
            if (in_array($shipment->orderKey, $orderKeys)) {
                continue;
            }

            $orderKeys[] = $shipment->orderKey;

            $order = Order::where('shipstation_key', $shipment->orderKey)
                ->first();

            $shippedAt = Carbon::now()->toDateTimeString();

            $order->shipped_at = $shippedAt;
            $order->save();

            $orderShipment = $order->default_shipment;
            $orderShipment->shipped_at = $shippedAt;
            $orderShipment->tracking_number = $shipment->trackingNumber;
        }
    }
}
