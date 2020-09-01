<?php

namespace App\Wax\Shop\Models;

use Wax\Shop\Models\Order as WaxOrder;
use App\Wax\Shop\Models\Order\Shipment;

class Order extends WaxOrder
{
    public function shipments()
    {
        return $this->hasMany(Shipment::class)->orderBy('id', 'asc');
    }

    public function validateShipping(): bool
    {
        if (!$this->shipments->count()) {
            return false;
        }

        // fulfillment will add shipping later,
        return true;
    }
}
