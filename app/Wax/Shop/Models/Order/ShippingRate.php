<?php

namespace App\Wax\Shop\Models\Order;

use Wax\Shop\Models\Order\ShippingRate as WaxShippingRate;

class ShippingRate extends WaxShippingRate
{
    protected $fillable = [
        'carrier',
        'service_name',
        'service_code',
        'business_transit_days',
        'amount',
        'actual_amount',
        'box_count',
        'packaging'
    ];
}
