<?php

namespace App\Listeners;

use Wax\Shop\Events\OrderPlacedEvent;
use Wax\Shop\Models\Coupon;

class OrderPlacedCouponListener
{
    public function handle(OrderPlacedEvent $event)
    {
        $order = $event->order();
        if (!$order->coupon) {
            return;
        }

        Coupon::where('code', $order->coupon->code)->increment('uses');
    }
}
