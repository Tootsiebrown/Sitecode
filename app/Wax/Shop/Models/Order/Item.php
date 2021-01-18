<?php

namespace App\Wax\Shop\Models\Order;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Models\Offer;
use App\Support\CouponInterface;
use Wax\Shop\Models\Order\Item as WaxItem;

/**
 * App\Wax\Shop\Models\Order\Item
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $shipment_id
 * @property int|null $quantity
 * @property int $product_id
 * @property string|null $brand
 * @property string $sku
 * @property string $name
 * @property float $price
 * @property string|null $shipping_flat_rate
 * @property int|null $shipping_enable_rate_lookup
 * @property int|null $shipping_disable_free_shipping
 * @property int|null $shipping_enable_tracking_number
 * @property float|null $dim_l
 * @property float|null $dim_w
 * @property float|null $dim_h
 * @property float $weight
 * @property int|null $one_per_user
 * @property int|null $taxable
 * @property int|null $discountable
 * @property string|null $discount_amount
 * @property int|null $bundle_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Order\ItemCustomization[] $customizations
 * @property-read int|null $customizations_count
 * @property-read mixed $bundles
 * @property-read \Wax\Shop\Models\Product\Category|null $category
 * @property-read float $flat_shipping_subtotal
 * @property-read float $gross_subtotal
 * @property-read float $gross_unit_price
 * @property-read \Wax\Shop\Models\Product\Image|null $image
 * @property-read int $inventory
 * @property-read mixed $listing
 * @property-read mixed $listing_id
 * @property-read \Wax\Shop\Models\Product\OptionModifier|null $modifier
 * @property-read mixed $offer
 * @property-read mixed $offer_id
 * @property-read string $short_description
 * @property-read mixed $subtotal
 * @property-read float $unit_price
 * @property-read string|null $url
 * @property-read \Illuminate\Database\Eloquent\Collection|ListingItem[] $listingItems
 * @property-read int|null $listing_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Order\ItemOption[] $options
 * @property-read int|null $options_count
 * @property-read \App\Wax\Shop\Models\Product $product
 * @property-read \Wax\Shop\Models\Order\Shipment $shipment
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @mixin \Eloquent
 */
class Item extends WaxItem
{
    protected $memoizedListing = null;
    protected $memoizedOffer = null;

    protected $appends = [
        'brand',

        'gross_unit_price',
        'unit_price',
        'gross_subtotal',
        'subtotal',

        'image',
        'url',
        'category',
        'bundles',

        'listing_id',
        'offer_id',
    ];

    public function getListingIdAttribute()
    {
        return (int) $this
            ->customizations
            ->filter(fn($customization) => $customization->customization === 'listing_id')
            ->first()
            ->value;
    }

    public function getListingAttribute()
    {
        if ($this->memoizedListing) {
            return $this->memoizedListing;
        }

        $this->memoizedListing = Listing::withoutGlobalScopes()->find($this->listing_id);

        return $this->memoizedListing;
    }

    public function getOfferIdAttribute()
    {
        $offerCustomziation = $this
            ->customizations
            ->filter(fn($customization) => $customization->customization === 'offer_id')
            ->first();

        if ($offerCustomziation) {
            return (int)$offerCustomziation->value;
        }

        return null;
    }

    public function getOfferAttribute()
    {
        if ($this->memoizedOffer) {
            return $this->memoizedOffer;
        }

        $this->memoizedOffer = Offer::withoutGlobalScopes()->find($this->offer_id);

        return $this->memoizedOffer;
    }

    public function listingItems()
    {
        return $this->hasMany(ListingItem::class, 'order_item_id');
    }

    public function getUrlAttribute(): ?string
    {
        return $this->listing->url ?? '';
    }

    public function getNameAttribute($value): string
    {
        return $value ?? $this->listing->title;
    }

    public function getPriceAttribute($value): float
    {
        if ($value > 0) {
            return $value;
        }

        if ($this->offer) {
            return $this->offer->counter_price ?? $this->offer->price;
        }

        if ($this->listing->type === 'auction') {
            return $this->listing->current_bid();
        }

        if ($this->listing->type === 'set-price') {
            return $this->listing->price;
        }

        throw new \Exception('Listing id: ' . $this->listing->id . 'of type ' . $this->listing->type . ' cannot have price calcualted properly.');
    }

    public function isDiscountableFor(CouponInterface $coupon)
    {
        if ($coupon->category_id) {
            return $this->listing->categories->pluck('id')->contains($coupon->category_id);
        } elseif ($coupon->listing_id) {
            return $this->listing_id === $coupon->listing_id;
        } else {
            return true;
        }
    }
}
