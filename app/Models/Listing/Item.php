<?php

namespace App\Models\Listing;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Wax\Shop\Models\Order\Item as OrderItem;

class Item extends Model
{
    public $timestamps = false;
    protected $table = 'listing_items';

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id')->withoutGlobalScopes();
    }

    public function scopeAvailable($query)
    {
        return $query->whereNull('order_item_id');
    }

    public function scopeSold($query)
    {
        return $query->whereNotNull('order_item_id');
    }

    public function scopeReserved($query)
    {
        return $query->whereNotNull('reserved_for_order_id');
    }

    public function scopeNotReserved($query)
    {
        return $query->whereNull('reserved_for_order_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function getRemovedAttribute()
    {
        return !is_null($this->removed_at);
    }

    public function toggleRemoved()
    {
        if ($this->removed) {
            $this->removed_at = null;
        } else {
            $this->removed_at = Carbon::now()->toDateTimeString();
        }

        $this->save();
    }
}
