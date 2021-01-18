<?php

namespace App\Models\Listing;

use Illuminate\Database\Eloquent\Model;

class EbayAspect extends Model
{
    protected $table = 'listing_ebay_aspects';
    public $timestamps = false;
    public $guarded = [];

    public function values()
    {
        return $this->hasMany(EbayAspectValue::class, 'aspect_id');
    }
}
