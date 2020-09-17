<?php

namespace App\Wax\Shop\Models\Order;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use Wax\Shop\Models\Order\Item as WaxItem;

class Item extends WaxItem
{
    protected $memoizedListing = null;

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

    public function listingItems()
    {
        return $this->hasMany(ListingItem::class, 'order_item_id');
    }

    public function getUrlAttribute(): ?string
    {
        return $this->listing->url;
    }

    public function getNameAttribute($value): string
    {
        return $value ?? $this->listing->title;
    }

    public function getGrossUnitPriceAttribute(): float
    {
        if ((float)$this->price > 0) {
            return $this->price;
        }

        if ($this->listing->type === 'auction') {
            return $this->listing->current_bid();
        }

        if ($this->listing->type === 'set-price') {
            return $this->listing->price;
        }

        throw new Exception('Listing id: ' . $this->listing->id . 'of type ' . $this->listing->type . ' cannot have price calcualted properly.');
    }
}