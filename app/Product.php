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
        return $query->whereNew(true);
    }

    public function scopeUsed($query)
    {
        return $query->whereNew(false);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_links', 'product_id', 'category_id');
    }

    public function getCategoryAttribute()
    {
        return $this->categories()->top()->first();
    }

    public function getChildCategoryAttribute()
    {
        if (! $this->category) {
            return null;
        }

        return $this->categories()->where('parent_id', $this->category->id)->first();
    }

    public function getGrandchildCategoryAttribute()
    {
        if (! $this->childcategory) {
            return null;
        }

        return $this->categories()->where('parent_id', $this->childcategory->id)->first();
    }

    public function getFeaturedImageAttribute()
    {
        return $this->images()->orderBy('featured', 'desc')->first();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function ads()
    {
        return $this->hasMany(Ad::class)->orderBy('id', 'desc');
    }
}
