<?php

namespace App\Models\Shop;

use Wax\Shop\Models\Coupon as WaxCoupon;

class Coupon extends WaxCoupon
{
    public function getTypeAttribute()
    {
        return $this->dollars ? 'dollars' : 'percent';
    }

    public function getDiscountAttribute()
    {
        return $this->type == 'dollars' ? $this->dollars : $this->percent;
    }
}
