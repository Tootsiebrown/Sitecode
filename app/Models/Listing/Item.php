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
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function scopeAvailable($query)
    {
        return $query->whereNull('order_item_id');
    }
}
