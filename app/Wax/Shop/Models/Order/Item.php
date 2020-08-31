<?php

namespace App\Wax\Shop\Models\Order;

use App\Ad;
use Wax\Shop\Models\Order\Item as WaxItem;

class Item extends WaxItem
{
    protected $memoizedAd = null;

    public function getAdIdAttribute()
    {
        return (int) $this
            ->customizations
            ->filter(fn($customization) => $customization->customization === 'ad_id')
            ->first()
            ->value;
    }

    public function getAdAttribute()
    {
        if ($this->memoizedAd) {
            return $this->memoizedAd;
        }

        $this->memoizedAd = Ad::find($this->ad_id);

        return $this->memoizedAd;
    }

    public function getUrlAttribute(): ?string
    {
        return $this->ad->url;
    }

    public function getNameAttribute($value): string
    {
        return $value ?? $this->ad->title;
    }

    public function getGrossUnitPriceAttribute(): float
    {
        if ((float)$this->price > 0) {
            return $this->price;
        }

        if ($this->ad->type === 'auction') {
            return $this->ad->current_bid();
        }

        throw new \Exception('Ad id: ' . $this->ad->id . 'of type ' . $this->ad->type . ' cannot have price calcualted properly.');
    }
}
