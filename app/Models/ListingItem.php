<?php

namespace App\Models;

class ListingItem extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;

    public function listings()
    {
        return $this->belongsTo(Ad::class, 'listing_id');
    }
}
