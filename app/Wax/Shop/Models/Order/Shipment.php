<?php

namespace App\Wax\Shop\Models\Order;

use Wax\Shop\Models\Order\Shipment as WaxShipment;
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

    public function validateShipping() : bool
    {
        if ($this->in_store_pickup) {
            return true;
        }

        if ($this->firstname
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

    protected function buildTaxRequest() : Request
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
}
