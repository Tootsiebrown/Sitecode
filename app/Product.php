<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Product extends Model
{
    use HasCondition;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_links', 'product_id', 'category_id');
    }

    public function getCategoryAttribute()
    {
        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === 0;
            })
            ->first();
    }

    public function getChildCategoryAttribute()
    {
        if (! $this->category) {
            return null;
        }

        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === $this->category->id;
            })
            ->first();
    }

    public function getGrandchildCategoryAttribute()
    {
        if (! $this->child_category) {
            return null;
        }

        return $this
            ->categories
            ->filter(function ($category) {
                return $category->parent_id === $this->child_category->id;
            })
            ->first();
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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
