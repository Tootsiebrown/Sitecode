<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Brand
 * @mixin Builder
 */
class Brand extends Model
{
    protected $guarded = [];

    public function getUrlAttribute()
    {
        return route('search', ['brand' => $this->id]);
    }

    public function scopeHasListings(Builder $query)
    {
        return $query->whereHas('listings');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
