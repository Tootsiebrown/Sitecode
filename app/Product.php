<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    use HasCondition;
    use HasProductCategories;

    protected $guarded = [];
    protected $dates = ['redone_at'];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_links', 'product_id', 'category_id');
    }

    public function getFeaturedImageAttribute()
    {
        return $this->images()->orderBy('featured', 'desc')->first();
    }

    public function images()
    {
        return $this
            ->hasMany(ProductImage::class)
            ->orderBy('sort_id');;
    }


    public function ads()
    {
        return $this->hasMany(Listing::class)->orderBy('id', 'desc');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function redoneBy()
    {
        return $this->belongsTo(User::class, 'redone_by_user_id');
    }
}
