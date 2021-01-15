<?php

namespace App\Wax\Shop\Models\Order;

use App\Support\CouponInterface;
use Wax\Shop\Events\OrderChanged\CartContentsChangedEvent;
use Wax\Shop\Events\OrderChanged\ShippingServiceChangedEvent;
use Wax\Shop\Models\Order\Shipment as WaxShipment;
use Wax\Shop\Models\Order\ShippingRate;
use Wax\Shop\Tax\Support\Address;
use Wax\Shop\Tax\Support\LineItem;
use Wax\Shop\Tax\Support\Request;
use Wax\Shop\Tax\Support\Shipping;
use Wax\Shop\Validators\OrderItemValidator;

/**
 * App\Wax\Shop\Models\Order\Shipment
 *
 * @property int $id
 * @property int|null $sequence
 * @property int $order_id
 * @property int|null $shipped_at
 * @property int|null $desired_delivery_date
 * @property string|null $tax_desc
 * @property bool|null $tax_shipping
 * @property string|null $tax_rate
 * @property string|null $tax_amount
 * @property string|null $shipping_carrier
 * @property string|null $shipping_service_code
 * @property string|null $shipping_service_name
 * @property string|null $shipping_service_amount
 * @property string|null $shipping_discount_amount
 * @property int|null $business_transit_days
 * @property int|null $box_count
 * @property string|null $packaging
 * @property string|null $tracking_number
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $company
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip
 * @property string|null $country
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $in_store_pickup
 * @property float|null $shipping_service_actual_amount
 * @property-read mixed $carrier_name
 * @property-read float $discountable_total
 * @property-read bool $enable_tracking_number
 * @property-read float $flat_shipping_subtotal
 * @property-read float $gross_total
 * @property-read int $item_count
 * @property-read float $item_discount_amount
 * @property-read float $item_gross_subtotal
 * @property-read float $item_subtotal
 * @property-read mixed $listing_ids
 * @property-read bool $require_carrier
 * @property-read float $shipping_gross_subtotal
 * @property-read float $shipping_subtotal
 * @property-read float $total
 * @property-read int $total_quantity
 * @property-read mixed $tracking_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wax\Shop\Models\Order\Item[] $items
 * @property-read int|null $items_count
 * @property-read \App\Wax\Shop\Models\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection|ShippingRate[] $rates
 * @property-read int|null $rates_count
 * @method static \Illuminate\Database\Eloquent\Builder|Shipment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Shipment query()
 * @mixin \Eloquent
 */
class Shipment extends WaxShipment
{
    protected $appends = [
        'carrier_name',
        'tracking_url',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function isAddressSet()
    {
        if ($this->in_store_pickup) {
            return true;
        }

        return !is_null(
            $this->firstname
            ?? $this->lastname
            ?? $this->address1
            ?? $this->address2
            ?? $this->city
            ?? $this->state
            ?? $this->zip
            ?? $this->country
        );
    }

    public function validateShipping(): bool
    {
        if ($this->in_store_pickup) {
            return true;
        }

        if (
            $this->firstname
            && $this->lastname
            && $this->email
            && $this->phone
            && $this->city
            && $this->state
            && $this->zip
        ) {
            return true;
        }

        return false;
    }

    protected function buildTaxRequest(): Request
    {
        if ($this->in_store_pickup) {
            $taxRequest = (new Request())
                ->setAddress(
                    new Address(
                        null,
                        null,
                        null,
                        null,
                        'KY',
                        null,
                        null
                    )
                )
                ->setShipping(new Shipping($this->shipping_service_name, $this->shipping_service_amount));
        } else {
            $taxRequest = (new Request())
                ->setAddress(
                    new Address(
                        $this->address1,
                        $this->address2,
                        null,
                        $this->city,
                        $this->state,
                        $this->zip,
                        $this->country
                    )
                )
                ->setShipping(new Shipping($this->shipping_service_name, $this->shipping_service_amount));
        }

        $this->items->each(function ($item) use ($taxRequest) {
            $taxRequest->addLineItem(new LineItem(
                $item->sku,
                $item->unit_price,
                $item->quantity,
                $item->taxable
            ));
        });

        return $taxRequest;
    }

    public function getListingIdsAttribute()
    {
        return $this
            ->items
            ->map(function ($item) {
                return $item->listing_id;
            });
    }

    public function setShippingService(ShippingRate $rate)
    {
        $this->shipping_carrier = $rate->carrier;
        $this->shipping_service_code = $rate->service_code;
        $this->shipping_service_name = $rate->service_name;
        $this->shipping_service_amount = $rate->amount;
        $this->shipping_service_actual_amount = $rate->actual_amount;
        $this->business_transit_days = $rate->business_transit_days;
        $this->box_count = $rate->box_count;
        $this->packaging = $rate->packaging;
        $result = $this->save();

        event(new ShippingServiceChangedEvent($this->order->fresh()));

        return $result;
    }

    public function combineDuplicateItems()
    {
        $this->items
            ->sortByDesc('created_at')
            ->each(function ($item) {
                $options = $item->options->mapWithKeys(function ($option) {
                    return [$option->option_id => $option->value_id];
                })->toArray();

                $customizations = $item->customizations->mapWithKeys(function ($customization) {
                    return [$customization->customization_id => $customization->value];
                })->toArray();

                if (($duplicate = $this->findItem($item->product_id, $options, $customizations)) && $item->isNot($duplicate)) {
                    $duplicate->quantity += $item->quantity;
                    $duplicate->save();
                    $item->delete();
                }
            });
    }

    public function updateItemQuantity(int $itemId, int $quantity)
    {
        app()->make(OrderItemValidator::class)
            ->setItemId($itemId)
            ->setQuantity($quantity)
            ->validate();

        $item = $this->items->where('id', $itemId)->first();

        if ($quantity === 0) {
            $item->delete();
        } else {
            $item->quantity = $quantity;
            $item->save();
        }

        event(new CartContentsChangedEvent($this->order));
    }

    public function getDiscountableTotalFor(CouponInterface $coupon)
    {
        if (is_null($coupon->category_id) && is_null($coupon->listing_id)) {
            return $this->items->where('discountable', 1)->sum('gross_subtotal');
        } else {
            return $this
                ->items
                ->where('discountable', 1)
                ->filter(fn($item) => $item->isDiscountableFor($coupon))
                ->sum('gross_subtotal');
        }
    }

    public function getCarrierNameAttribute()
    {

        $carriers = [
            'fedex' => 'Fedex',
            'stamps_com' => 'US Postal Service',
            'ups_walleted' => 'UPS',
        ];

        if (array_key_exists($this->shipping_carrier, $carriers)) {
            return $carriers[$this->shipping_carrier];
        }

        return $this->shipping_carrier;
    }

    public function getTrackingUrlAttribute()
    {
        if ($this->shipping_carrier === 'fedex' && !empty($this->tracking_number)) {
            return 'https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber=' . $this->tracking_number . '&cntry_code=us&locale=en_US';
        }

        if ($this->shipping_carrier === 'stamps_com') {
            return 'https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels=' . $this->tracking_number . '%2C&tABt=false';
        }

        if ($this->shipping_carrier === 'ups_walleted') {
            return 'https://www.ups.com/track?loc=null&tracknum=' . $this->tracking_number . '&requester=MB/trackdetails';
        }
    }
}
