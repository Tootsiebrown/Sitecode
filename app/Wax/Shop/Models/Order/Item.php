<?php

namespace App\Wax\Shop\Models\Order;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Models\Offer;
use Wax\Shop\Models\Order\Item as WaxItem;

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
}
