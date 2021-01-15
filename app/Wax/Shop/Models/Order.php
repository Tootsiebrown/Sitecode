<?php

namespace App\Wax\Shop\Models;

use App\Support\CouponInterface;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Wax\Core\Support\Localization\Currency;
use Wax\Shop\Events\OrderChanged\CouponChangedEvent;
use Wax\Shop\Models\Bundle;
use Wax\Shop\Models\Order as WaxOrder;
use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order\Shipment;
use App\Wax\Shop\Models\Order\Coupon as OrderCoupon;

/**
 * App\Wax\Shop\Models\Order
 *
 * @property int $id
 * @property int|null $sequence
 * @property int|null $user_id
 * @property string|null $session_id
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $placed_at
 * @property Carbon|null $processed_at
 * @property Carbon|null $shipped_at
 * @property Carbon|null $archived_at
 * @property string|null $total
 * @property string|null $email
 * @property string|null $ip_address
 * @property string|null $searchIndex
 * @property string|null $canceled_at
 * @property int|null $canceled_by_user_id
 * @property string|null $shipstation_key
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Order\Bundle[] $bundles
 * @property-read int|null $bundles_count
 * @property-read User|null $canceledBy
 * @property-read \Wax\Shop\Models\Order\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection|OrderCoupon[] $coupons
 * @property-read int|null $coupons_count
 * @property-read mixed $balance_due
 * @property-read mixed $bundle_value
 * @property-read mixed $canceled
 * @property-read mixed $coupon_value
 * @property-read mixed $default_shipment
 * @property-read mixed $discount_amount
 * @property-read mixed $discountable_total
 * @property-read mixed $flat_shipping_subtotal
 * @property-read mixed $gross_total
 * @property-read mixed $item_count
 * @property-read mixed $item_discount_amount
 * @property-read mixed $item_gross_subtotal
 * @property-read mixed $item_subtotal
 * @property-read mixed $items
 * @property-read mixed $payment_total
 * @property-read mixed $shipped
 * @property-read mixed $shipping_discount_amount
 * @property-read mixed $shipping_gross_subtotal
 * @property-read mixed $shipping_service_subtotal
 * @property-read mixed $shipping_subtotal
 * @property-read mixed $tax_subtotal
 * @property-read mixed $total_quantity
 * @property-read mixed $weight
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Order\Payment[] $paymentErrors
 * @property-read int|null $payment_errors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Order\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Shipment[] $shipments
 * @property-read int|null $shipments_count
 * @method static Builder|Order active()
 * @method static Builder|Order archived()
 * @method static Builder|Order mine()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order notShipped()
 * @method static Builder|Order placed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order placedMonth($year, $month)
 * @method static \Illuminate\Database\Eloquent\Builder|Order placedYear($year)
 * @method static Builder|Order processed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static Builder|Order shipped()
 * @mixin \Eloquent
 */
class Order extends WaxOrder
{
    protected $with = ['shipments', 'payments', 'coupons', 'bundles'];
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

        $this->coupons()->create([
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

    public function getCouponValueAttribute()
    {
        return Currency::round($this->coupons->sum->calculated_value ?? 0);
    }

    public function calculateDiscounts()
    {
        // make sure coupon / bundle relations are up to date
        $this->refresh();

        $this->resetDiscounts();

        if ($this->coupons->isNotEmpty()) {
            $this->coupons->each->calculateValue();
            $this->refresh();
        }

        $bundlesTouched = $this->applyBundleDiscounts();

        if ($bundlesTouched > 0) {
            $this->refresh();
        }
        event(new CouponChangedEvent($this));
    }

    public function getDiscountableTotalFor(CouponInterface $coupon)
    {
        if (is_null($coupon->category_id) && is_null($coupon->listing_id)) {
            return $this->discountable_total;
        }

        return $this->shipments->sum(fn($shipment) => $shipment->getDiscountableTotalFor($coupon));
    }

    public function removeCouponByCode(string $code)
    {
        if ($this->coupons->isEmpty()) {
            return;
        }

        $this
            ->coupons
            ->filter(fn ($coupon) => $coupon->code === $code)
            ->first()
            ->delete();

        $this->calculateDiscounts();
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

    public function coupons()
    {
        return $this->hasMany(OrderCoupon::class, 'order_id');
    }

    protected function resetDiscounts()
    {
        // trigger individual deletes so the 'deleting' event is caught
        $this->bundles->each->delete();

        $wereShipmentsModified = $this->shipments->map(function ($shipment) {
            $shipment->shipping_discount_amount = null;
            $shipment->save();
            return $shipment->wasChanged();
        })->reduce(function ($carry, $item) {
            return $carry || $item;
        });

        $wereItemsModified = $this->items->map(function ($item) {
            $item->discountable = null;
            $item->discount_amount = null;
            $item->bundle_id = null;
            $item->save();
            return $item->wasChanged();
        })->reduce(function ($carry, $item) {
            return $carry || $item;
        });

        $wasCouponModified = false;
        if ($this->coupons->isNotEmpty()) {
            $wasCouponModified = $this->coupons->reduce(function ($wasCouponModified, $coupon) {
                $coupon->calculated_value = null;
                $coupon->save();
                $wasThisCouponModified = $this->coupon->wasChanged();

                return $wasThisCouponModified || $wasCouponModified;
            }, $wasCouponModified);
        }

        if ($wereShipmentsModified || $wereItemsModified || $wasCouponModified) {
            $this->refresh();
        }
    }
}
