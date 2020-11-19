<?php

namespace App\Wax\Shop\Models;

use App\Support\CouponInterface;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Wax\Shop\Models\Bundle;
use Wax\Shop\Models\Order as WaxOrder;
use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order\Shipment;
use App\Wax\Shop\Models\Order\Coupon as OrderCoupon;

class Order extends WaxOrder
{
    public function shipments()
    {
        return $this->hasMany(Shipment::class)->orderBy('id', 'asc');
    }

    public function applyCoupon(string $code): bool
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return false;
        }

        if (!$coupon->validate($this)) {
            return false;
        }

        if ($this->coupon) {
            $this->coupon->delete();
        }

        $this->coupon()->create([
            'title' => $coupon->title,
            'code' => $coupon->code,
            'expired_at' => $coupon->expired_at,
            'dollars' => $coupon->dollars,
            'percent' => $coupon->percent,
            'minimum_order' => $coupon->minimum_order,
            'one_time' => $coupon->one_time,
            'include_shipping' => $coupon->include_shipping,
            'category_id' => $coupon->category_id,
        ]);

        $this->calculateDiscounts();

        return true;
    }

    public function getDiscountableTotalFor(CouponInterface $coupon)
    {
        if (is_null($coupon->category_id)) {
            return $this->discountable_total;
        }

        return $this->shipments->sum(fn($shipment) => $shipment->getDiscountableTotalFor($coupon));
    }

    protected function applyBundleDiscounts()
    {
        $orderProductIds = $this->items->pluck('product_id');

        $bundles = Bundle::whereHas('products', function ($query) use ($orderProductIds) {
            $query->whereIn('wax_products.id', $orderProductIds);
        })->orderBy('percent', 'desc')->get();

        $bundlesTouched = $bundles->filter(function ($bundle) use ($orderProductIds) {
            return $bundle->products->count() == $orderProductIds->intersect($bundle->products->pluck('id'))->count();
        })->each(function ($bundle) {
            $items = $this->items
                ->where('discount_amount', 0)
                ->wherein('product_id', $bundle->products->pluck('id'));

            if ($items->isEmpty()) {
                return;
            }

            $orderBundle = $this->bundles()->create([
                'name' => $bundle->name,
                'percent' => $bundle->percent,
            ]);
            $orderBundle->items()->saveMany($items);

            $items->each(function ($item) use ($orderBundle) {
                $item->discount_amount = round($item->gross_subtotal * $orderBundle->percent / 100, 2);
                $item->bundle_id = $orderBundle->id;
                $item->save();
            });

            $orderBundle->refresh();
            $orderBundle->calculated_value = $orderBundle->items->sum('discount_amount');
            $orderBundle->save();

            $this->refresh();
        })->count();

        return $bundlesTouched;
    }

    public function getDefaultShipmentAttribute()
    {
        if (!empty($this->shipments->first())) {
            return $this->shipments->first();
        }

        return $this->shipments()->firstOrCreate([]);
    }

    public function getShippedAttribute()
    {
        return $this
            ->shipments
            ->filter(function ($shipment) {
                return is_null($shipment->shipped_at);
            })
            ->count() === 0;
    }

    public function getCanceledAttribute()
    {
        return !is_null($this->canceled_at);
    }

    public function cancel()
    {
        DB::table('listing_items')
            ->where('reserved_for_order_id', $this->id)
            ->update([
                'reserved_for_order_id' => null,
                'order_item_id' => null,
                'removed_at' => null,
                'reserved_for_offer_id' => null,
            ]);

        $this->canceled_by_user_id = Auth::user()->id;
        $this->canceled_at = Carbon::now()->toDateTimeString();
        $this->save();
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by_user_id');
    }

    public function getWeightAttribute()
    {
        return $this->default_shipment
            ->items
            ->map(function ($item) {
                $itemWeight = empty($item->listing->shipping_weight_oz)
                    ? 8
                    : $item->listing->shipping_weight_oz;
                return $item->quantity * $itemWeight;
            })
            ->sum();
    }

    public function scopePlacedMonth($query, $year, $month)
    {
        $startDate = new Carbon();
        $startDate->setYear($year);
        $startDate->setMonth($month);
        $endDate = clone $startDate;

        $startDate->startOfMonth();
        $endDate->endOfMonth();

        return $query->whereBetween('placed_at', [$startDate, $endDate]);
    }

    public function scopePlacedYear($query, $year)
    {
        $startDate = new Carbon();
        $startDate->setYear($year);
        $endDate = clone $startDate;

        $startDate->startOfYear();
        $endDate->endOfYear();

        return $query->whereBetween('placed_at', [$startDate, $endDate]);
    }

    public function scopeNotShipped($query)
    {
        return $query->whereNull('shipped_at');
    }

    public function coupon()
    {
        return $this->hasOne(OrderCoupon::class, 'order_id');
    }
}
