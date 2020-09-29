<?php

namespace App\Wax\Shop\Services;

use App\Wax\Shop\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use LaravelShipStation\Models\AdvancedOptions;
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
            ->filter(function ($carrier) {
                return in_array($carrier->code, config('shipping.carriers'));
            })
            ->map(function ($carrier) use ($order) {
                $weight = new Weight();
                $weight->value = $order->weight;
                $weight->units = 'ounces';

                try {
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
                } catch (\Exception $e) {
                    if (strpos($e->getMessage(), "No applicable services were available for the configured shipmen") === 0) {
                        return null;
                    }

                    $services = [];
                }

                return collect($services)
                    ->filter()
                    ->map(function ($service) use ($carrier) {
                        $service->carrier = $carrier;
                        return $service;
                    });
            })
            ->flatten()
            ->filter()
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

    public function record(Order $order)
    {
        $weight = new Weight();
        $weight->value = $order->weight;
        $weight->units = 'ounces';

        $shipstationOrder = new \LaravelShipStation\Models\Order();
        $shipstationOrder->orderNumber = $order->sequence;
        $shipstationOrder->orderDate = $order->placed_at->toDateString();
        $shipstationOrder->orderStatus = 'awaiting_shipment';
        $shipstationOrder->orderDate = $order->placed_at->toDateString();
        $shipstationOrder->amountPaid = $order->total;
        $shipstationOrder->taxAmount = $order->tax_subtotal;
        $shipstationOrder->shippingAmount = $order->shipping_subtotal;
        $shipstationOrder->billTo = $this->getShipstationBillTo($order);
        $shipstationOrder->shipTo = $this->getShipstationShipTo($order);
        $shipstationOrder->items = $this->getShipstationItems($order);
        $shipstationOrder->requestedShippingService = $order->default_shipment->shipping_service_name;
        $shipstationOrder->carrierCode = $order->default_shipment->shipping_carrier;
        $shipstationOrder->serviceCode = $order->default_shipment->shipping_service_code;
        $shipstationOrder->advancedOptions = $this->getAdvancedOptions($order);
        $shipstationOrder->weight = $weight;

        if ($order->shipstation_key) {
            $shipstationOrder->orderKey = $order->shipstation_key;
        }

        $result = $this->shipStation->orders->post($shipstationOrder, 'createorder');
        if ($order->shipstation_key != $result->orderKey) {
            $order->shipstation_key = $result->orderKey;
            $order->save();
        }
    }

    protected function getShipstationBillTo(Order $order)
    {
        $payment = $order->payments->first();
        $address = new \LaravelShipStation\Models\Address();
        $address->name = $payment->firstname . ' ' . $payment->lastname;
        $address->street1 = $payment->address1;
        $address->street2 = $payment->address2;
        $address->city = $payment->city;
        $address->state = $payment->state;
        $address->postalCode = $payment->zip;
        $address->country = 'US';

        return $address;
    }

    protected function getShipstationShipTo(Order $order)
    {
        $shipment = $order->default_shipment;
        $address = new \LaravelShipStation\Models\Address();
        $address->name = $shipment->firstname . ' ' . $shipment->lastname;
        $address->street1 = $shipment->address1;
        $address->street2 = $shipment->address2;
        $address->city = $shipment->city;
        $address->state = $shipment->state;
        $address->postalCode = $shipment->postalCode = $shipment->zip;
        $address->country = 'US';

        return $address;
    }

    protected function getShipstationItems(Order $order)
    {
        $shipstationItems = [];

        foreach ($order->default_shipment->items as $item) {
            $shipstationItem = new \LaravelShipStation\Models\OrderItem();

            $shipstationItem->lineItemKey = $item->id;
            $shipstationItem->sku = $item->listing_id;
            $shipstationItem->name = $item->name;
            $shipstationItem->quantity = $item->quantity;
            $shipstationItem->unitPrice = $item->price;
            $shipstationItem->warehouseLocation = $this->getWarehouseLocation($item);

            $shipstationItems[] = $shipstationItem;
        }

        return $shipstationItems;
    }

    protected function getWarehouseLocation(Order\Item $item)
    {
        $location = 'ItemId:Bin,';
        foreach ($item->listing->items as $listingItem) {
            $location .= $listingItem->id . ':' . $listingItem->bin . ',';
        }

        return trim($location, ',');
    }

    public function getAdvancedOptions(Order $order)
    {
        $advancedOptions = new AdvancedOptions();

        $location = 'ItemId:Bin,';
        foreach ($order->items as $orderItem) {
            foreach ($orderItem->listing->items as $listingItem) {
                if ($listingItem->order_item_id !== $orderItem->id) {
                    continue;
                }
                $location .= $listingItem->id . ':' . $listingItem->bin . ',';
            }
        }

        $advancedOptions->customField1 = trim($location, ',');

        return $advancedOptions;
    }
}
