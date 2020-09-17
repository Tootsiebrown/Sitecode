<?php

namespace App\Models\Listing;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

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
}
