<?php

namespace App\Wax\Shop\Models\Order;

use App\Wax\Shop\Models\Order\Item;
use Wax\Shop\Events\OrderChanged\ShippingServiceChangedEvent;
use Wax\Shop\Models\Order\Shipment as WaxShipment;
use Wax\Shop\Models\Order\ShippingRate;
use Wax\Shop\Tax\Support\Address;
use Wax\Shop\Tax\Support\LineItem;
use Wax\Shop\Tax\Support\Request;
use Wax\Shop\Tax\Support\Shipping;

class Shipment extends WaxShipment
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function isAddressSet()
    {
        if ($this->in_store_pickup) {
            return true;
        }

        return !is_null(
            $this->firstname
            ?? $this->lastname
            ?? $this->address1
            ?? $this->address2
            ?? $this->city
            ?? $this->state
            ?? $this->zip
            ?? $this->country
        );
    }

    public function validateShipping(): bool
    {
        if ($this->in_store_pickup) {
            return true;
        }

        if (
            $this->firstname
            && $this->lastname
            && $this->email
            && $this->phone
            && $this->city
            && $this->state
            && $this->zip
        ) {
            return true;
        }

        return false;
    }

    protected function buildTaxRequest(): Request
    {
        if ($this->in_store_pickup) {
            $taxRequest = (new Request())
                ->setAddress(
                    new Address(
                        null,
                        null,
                        null,
                        null,
                        'KY',
                        null,
                        null
                    )
                )
                ->setShipping(new Shipping($this->shipping_service_name, $this->shipping_service_amount));
        } else {
            $taxRequest = (new Request())
                ->setAddress(
                    new Address(
                        $this->address1,
                        $this->address2,
                        null,
                        $this->city,
                        $this->state,
                        $this->zip,
                        $this->country
                    )
                )
                ->setShipping(new Shipping($this->shipping_service_name, $this->shipping_service_amount));
        }

        $this->items->each(function ($item) use ($taxRequest) {
            $taxRequest->addLineItem(new LineItem(
                $item->sku,
                $item->unit_price,
                $item->quantity,
                $item->taxable
            ));
        });

        return $taxRequest;
    }

    public function getListingIdsAttribute()
    {
        return $this
            ->items
            ->map(function ($item) {
                return $item->listing_id;
            });
    }

    public function setShippingService(ShippingRate $rate)
    {
        $this->shipping_carrier = $rate->carrier;
        $this->shipping_service_code = $rate->service_code;
        $this->shipping_service_name = $rate->service_name;
        $this->shipping_service_amount = $rate->amount;
        $this->shipping_service_actual_amount = $rate->actual_amount;
        $this->business_transit_days = $rate->business_transit_days;
        $this->box_count = $rate->box_count;
        $this->packaging = $rate->packaging;
        $result = $this->save();

        event(new ShippingServiceChangedEvent($this->order->fresh()));

        return $result;
    }

    public function combineDuplicateItems()
    {
        $this->items
            ->sortByDesc('created_at')
            ->each(function ($item) {
                $options = $item->options->mapWithKeys(function ($option) {
                    return [$option->option_id => $option->value_id];
                })->toArray();

                $customizations = $item->customizations->mapWithKeys(function ($customization) {
                    return [$customization->customization_id => $customization->value];
                })->toArray();

                if (($duplicate = $this->findItem($item->product_id, $options, $customizations)) && $item->isNot($duplicate)) {
                    $duplicate->quantity += $item->quantity;
                    $duplicate->save();
                    $item->delete();
                }
            });
    }
}
