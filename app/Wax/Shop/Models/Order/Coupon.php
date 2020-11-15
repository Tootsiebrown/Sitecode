<?php

namespace App\Wax\Shop\Models\Order;

use App\Support\CouponInterface;
use App\Wax\Shop\Models\Coupon as RawCoupon;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Illuminate\Database\Eloquent\Model;
use Wax\Shop\Models\Order;
use Wax\Shop\Models\Order\Coupon as WaxCoupon;

class Coupon extends WaxCoupon implements CouponInterface
{
    protected $fillable = [
        'title',
        'code',
        'expired_at',
        'dollars',
        'percent',
        'minimum_order',
        'one_time',
        'include_shipping',
        'category_id',
    ];

    public function validate()
    {
        $rawCoupon = $this->getOriginalCoupon();

        if (! $rawCoupon) {
            return false;
        }

        return $this->validateCouponForOrder($rawCoupon, $this->order);
    }

    public function validateCouponForOrder(Model $rawCoupon, Order $order)
    {
        return (new OrderCouponValidator($order, $rawCoupon))->passes();
    }

    protected function getOriginalCoupon(): ?RawCoupon
    {
        return RawCoupon::where('code', $this->code)->first();
    }

    protected function calculateBaseValue()
    {
        $discountableTotal = $this->order->getDiscountableTotalFor($this);

        return min(
            $discountableTotal,
            $this->dollars + round($discountableTotal * ($this->percent / 100), 2)
        );
    }

    protected function distributeCouponValueToCart($couponValue)
    {
        $items = $this->order->items;

        foreach ($items as $item) {
            if ($item->discountable && $item->isDiscountableFor($this) && ($item->discount_amount == 0)) {
                $ratio = $item->gross_subtotal / $this->order->getDiscountableTotalFor($this);
                $item->discount_amount = min($couponValue, round($ratio * $this->calculated_value, 2));
                $couponValue -= $item->discount_amount;
            }
            $item->save();
        }

        if ($couponValue == 0) {
            return;
        }

        // if there is any unapplied value left due to rounding (like a penny maybe),
        // apply it the first item that's discountable
        $couponValue = round($couponValue, 2);

        foreach ($items as $item) {
            if ($item->discountable && $item->isDiscountableFor($this)) {
                $addl = min($couponValue, $item->subtotal);
                $item->discount_amount += $addl;
                $couponValue -= $addl;
                if ($addl != 0) {
                    $item->save();
                }
            }
            if ($couponValue == 0) {
                break;
            }
        }
    }
}
