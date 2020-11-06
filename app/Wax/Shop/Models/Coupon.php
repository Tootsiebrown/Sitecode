<?php

namespace App\Wax\Shop\Models;

use App\Wax\Shop\Validators\OrderCouponValidator;
use Wax\Shop\Models\Coupon as WaxCoupon;
use Wax\Shop\Models\Order;

class Coupon extends WaxCoupon
{
    protected $casts = [
        'expired_at' => 'datetime',
        'uses' => 'integer',
        'permitted_uses' => 'integer',
        'one_time' => 'boolean',
    ];

    public function validate(Order $order)
    {
        return (new OrderCouponValidator($order, $this))->passes();
    }
}
