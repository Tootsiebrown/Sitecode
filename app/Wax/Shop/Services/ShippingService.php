<?php

namespace App\Wax\Shop\Services;

use App\Wax\Shop\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use LaravelShipStation\Models\Weight;
use LaravelShipStation\ShipStation;
use App\Wax\Shop\Models\Order\ShippingRate;

class ShippingService
{
    /** @var ShipStation */
    protected ShipStation $shipStation;

    public function __construct(ShipStation $shipStation)
    {
        $this->shipStation = $shipStation;
    }

    public function refreshRatesFor(Order $order)
    {
        $shipment = $order->default_shipment;
        $carriers = $this->carriers();
        $rates = collect($carriers)
            ->map(function ($carrier) use ($order) {
                $weight = new Weight();
                $weight->value = 20;
                $weight->units = 'ounces';

                $services = $this->shipStation->shipments->post(
                    [
                        'carrierCode' => $carrier->code,
                        'fromPostalCode' => config('services.ship_station.from_postal_code'),
                        'toCountry' => 'US',
                        'toPostalCode' => $order->default_shipment->zip,
                        'weight' => $weight,
                    ],
                    'getrates'
                );

                return collect($services)
                    ->map(function ($service) use ($carrier) {
                        $service->carrier = $carrier;
                        return $service;
                    });
            })
            ->flatten()
            ->filter(function ($service) {
                return in_array($service->serviceName, config('shipping.services'));
            })
            ->map(function ($service) use ($shipment) {
                if (
                    $shipment->item_gross_subtotal > config('shipping.free_shipping_threshold')
                    && $service->serviceName == config('shipping.free_shipping_service')
                ) {
                    $discountedAmount = 0;
                } else {
                    $discountedAmount = $service->shipmentCost;
                }

                return new ShippingRate([
                    'carrier' => $service->carrier->code,
                    'service_code' => $service->serviceCode,
                    'service_name' => $service->serviceName,
                    'amount' => $discountedAmount,
                    'actual_amount' => $service->shipmentCost,
                    'box_count' => 1
                ]);
            });

        $shipment->rates()->delete();
        $shipment->rates()->saveMany($rates);

        return $rates;
    }

    public function carriers()
    {
        return Cache::remember(
            'shipstation.carriers',
            Carbon::now()->addWeeks(1),
            function () {
                return $this->shipStation->carriers->get();
            }
        );
    }
}
