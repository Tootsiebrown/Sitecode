<?php

namespace App\Wax\Shop\Models\Order;

use App\Wax\Shop\Models\Coupon as RawCoupon;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Illuminate\Database\Eloquent\Model;
use Wax\Shop\Models\Order;
use Wax\Shop\Models\Order\Coupon as WaxCoupon;

class Coupon extends WaxCoupon
{
    public function validate()
    {
        $rawCoupon = $this->getOriginalCoupon();

        if (! $rawCoupon) {
            return false;
        }

        $this->validateCouponForOrder($rawCoupon, $this->order);
    }

    public function validateCouponForOrder(Model $rawCoupon, Order $order)
    {
        return (new OrderCouponValidator($order, $rawCoupon))->passes();
    }

    protected function getOriginalCoupon(): ?RawCoupon
    {
        return RawCoupon::where('code', $this->code)->first();
    }
}
