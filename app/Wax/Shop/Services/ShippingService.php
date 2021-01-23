<?php

namespace App\Wax\Shop\Services;

use App\Support\ShipstationListingItems;
use App\Wax\Shop\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use LaravelShipStation\Models\AdvancedOptions;
use LaravelShipStation\Models\Weight;
use LaravelShipStation\ShipStation;
use App\Wax\Shop\Models\Order\ShippingRate;
use Wax\Shop\Events\OrderChanged\ShippingServiceChangedEvent;

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
            ->map(function ($carrier) use ($order, $shipment) {
                if (! config('shipping.custom_shipping')) {
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
                } else {
                    $service = new \stdClass();
                    $service->serviceName = 'Custom Shipping';
                    $service->serviceCode = 'custom_shipping';
                    $service->shipmentCost = $this->getCustomShippingCost($shipment);

                    $services = [$service];
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

        if (config('shipping.custom_shipping')) {
            $order->default_shipment->setShippingService($rates->first());
        }

        event(new ShippingServiceChangedEvent($order->fresh()));

        return $rates;
    }

    public function getCustomShippingCost($shipment)
    {
        foreach (config('shipping.custom_shipping_tiers') as $orderCost => $shippingCost) {
            if ($shipment->item_gross_subtotal >= $orderCost) {
                return $shippingCost;
            }
        }
    }

    public function carriers()
    {
        if (config('shipping.custom_shipping')) {
            $carrier = new \stdClass();
            $carrier->code = 'custom';

            return [$carrier];
        }

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
        $order->refresh();
        $listingItemIds = new ShipstationListingItems($order);

        $weight = new Weight();
        $weight->value = $order->weight;
        $weight->units = 'ounces';
        $shipstationOrder = new \LaravelShipStation\Models\Order();
        $shipstationOrder->orderNumber = (App::environment() !== 'production' ? (App::environment() . '-') : '') . $order->sequence;
        $shipstationOrder->orderDate = $order->placed_at->setTimezone('America/Los_Angeles')->toDateTimeString();
        $shipstationOrder->orderStatus = 'awaiting_shipment';
        $shipstationOrder->amountPaid = $order->total;
        $shipstationOrder->taxAmount = $order->tax_subtotal;
        $shipstationOrder->shippingAmount = $order->shipping_subtotal;
        $shipstationOrder->billTo = $this->getShipstationBillTo($order);
        $shipstationOrder->shipTo = $this->getShipstationShipTo($order);
        $shipstationOrder->items = $this->getShipstationItems($order, $listingItemIds);
        $shipstationOrder->requestedShippingService = $order->default_shipment->shipping_service_name;
        if (! config('shipping.custom_shipping')) {
            $shipstationOrder->carrierCode = $order->default_shipment->shipping_carrier;
        }
        $shipstationOrder->serviceCode = $order->default_shipment->shipping_service_code;
        $shipstationOrder->advancedOptions = $this->getAdvancedOptions($order, $listingItemIds);

        if (
            $listingItemIds->tooLongForCustomField($shipstationOrder->advancedOptions->customField1)
            || $listingItemIds->hasTotalOverflow()
        ) {
            $shipstationOrder->internalNotes = 'Listing SKUs or item SKUs to long to show in shipstation. Please refer to website.';
        }
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

    protected function getShipstationItems(Order $order, ShipstationListingItems $listingItemIds)
    {
        $shipstationItems = [];

        foreach ($order->default_shipment->items as $item) {
            $shipstationItem = new \LaravelShipStation\Models\OrderItem();

            $shipstationItem->lineItemKey = $item->id;
            // this field has a max-length of 230
            $shipstationItem->sku = $listingItemIds->getSku();
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

    public function getAdvancedOptions(Order $order, ShipstationListingItems $listingItems)
    {
        $advancedOptions = new AdvancedOptions();

        $listingSkus = $order
            ->items
            ->map(fn($item) => $item->listing)
            ->pluck('id')
            ->implode(', ');

        $advancedOptions->customField1 = "Listing SKUs: $listingSkus";

        if ($listingItems->hasCustomFieldTwoOverflow()) {
            $advancedOptions->customField2 = 'Item SKUs: ' . $listingItems->getCustomFieldTwo();
        }

        if ($listingItems->hasCustomFieldThreeOverflow()) {
            $advancedOptions->customField3 = 'Item SKUs: ' . $listingItems->getCustomFieldThree();
        }

        return $advancedOptions;
    }

    public function listShipstationStores()
    {
        return collect($this->shipStation->stores->get())
            ->map(function ($store) {
                return (array) $store;
            });
    }

    public function listShipstationWebHooks()
    {
        return collect($this->shipStation->webhooks->get()->webhooks);
    }

    public function createShipstationWebHookForOrderShipped()
    {
        $this->shipStation->webhooks->post(
            [
                'target_url' => route('webhooks.order-shipped'),
                'store_id' => config('services.ship_station.store_id'),
                'event' => 'SHIP_NOTIFY',
                'friendly_name' => 'Notify website when order shipped (label printed)',
            ],
            'subscribe'
        );
    }

    public function getShipstationOrder($sequence)
    {
        return $this
            ->shipStation
            ->orders
            ->get([
                'sortBy' => 'OrderDate',
                'sortDir' => 'DESC',
                'pageSize' => 1,
                'orderNumber' => $sequence
            ])
            ->orders[0];
    }

    public function getAllShipstationOrders()
    {
        return $this->shipStation->orders->get([
            'sortBy' => 'OrderDate',
            'sortDir' => 'DESC',
            'pageSize' => 20,
        ]);
    }
}
