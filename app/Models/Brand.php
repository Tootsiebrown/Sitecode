<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brand
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Listing[] $listings
 * @property-read int|null $listings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|Brand hasListings()
 * @method static Builder|Brand newModelQuery()
 * @method static Builder|Brand newQuery()
 * @method static Builder|Brand query()
 * @mixin \Eloquent
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
