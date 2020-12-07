<?php

namespace App\Jobs;

use App\Exceptions\ShipstationOrderNotFoundException;
use App\Wax\Shop\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use LaravelShipStation\ShipStation;
use Wax\Shop\Mail\OrderShipped;

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

            $environment = App::environment();
            if ($environment !== 'production' && strpos($shipment->orderNumber, $environment) !== 0) {
                // we're in a non-production environment and the order
                // doesn't have this environment string identifier
                continue;
            } elseif ($environment === 'production' && strpos($shipment->orderNumber, '-') !== false) {
                // we're in the production environment, and the order has
                // some identifier.. prod should have no such identifier
                continue;
            }


            $order = Order::where('shipstation_key', $shipment->orderKey)
                ->first();

            if (!$order) {
                throw new ShipstationOrderNotFoundException(
                    'Failed to find order key ' . $shipment->orderKey .
                    ' for order ID' . $shipment->orderId .
                    ' in environment "' . config('app.env') . "'"
                );
            }

            $shippedAt = Carbon::now()->toDateTimeString();

            $order->shipped_at = $shippedAt;
            $order->save();

            $orderShipment = $order->default_shipment;
            $orderShipment->shipped_at = $shippedAt;
            $orderShipment->tracking_number = $shipment->trackingNumber;
            $orderShipment->shipping_carrier = $shipment->carrierCode;
            $orderShipment->shipping_service_actual_amount = $shipment->shipmentCost;
            $orderShipment->shipping_service_code = $shipment->serviceCode;

            $orderShipment->save();

            Mail::to($order->email)
                ->queue(new OrderShipped($order));

            if (config('shipping.copy_shipped_email')) {
                Mail::to(config('shipping.copy_shipped_email'))
                    ->queue(new OrderShipped($order));
            }
        }
    }
}
