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
}
