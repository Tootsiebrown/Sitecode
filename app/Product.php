<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $guarded = [];

    public function scopeNew($query)
    {
        return $query->whereCondition('1');
    }

    public function scopeUsed($query)
    {
        return $query->whereCondition('0');
    }

    public function category()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_links', 'product_id', 'category_id');
    }

//     public function feature_img()
//     {
//         $feature_img = $this->hasOne(Media::class)->whereIsFeature('1');
//         if (! $feature_img) {
//             $feature_img = $this->hasOne(Media::class)->first();
//         }
//         return $this->hasOne(Media::class);
//     }
    public function images()
    {
        return $this->hasMany(ProductImage::class)->whereType('image');
    }


    public function ads()
    {
        return $this->hasMany(Ad::class)->orderBy('id', 'desc');
    }
}
