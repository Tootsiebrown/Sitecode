<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Model;

class EbayAspectValue extends Model
{
    protected $table = 'listing_ebay_aspect_values';
    public $timestamps = false;
    public $guarded = [];

    public function values()
    {
        return $this->hasMany(EbayAspectValue::class, 'aspect_id');
    }
}
