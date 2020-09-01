<?php

namespace App\Wax\Shop\Models\Order;

use App\Wax\Shop\Models\Order\Item;
use Wax\Shop\Models\Order\Shipment as WaxShipment;

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
}
