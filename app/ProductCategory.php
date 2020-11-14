<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class ProductCategory extends Model
{
    protected $guarded = [];

    public function scopeTop($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeHasListings(Builder $query)
    {
        return $query->whereHas('listings');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function hasChildren()
    {
        return $this->children->count() > 0;
    }

    public function getUrlAttribute()
    {
        return route('search', [
            'category' => $this->id
        ]);
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'ad_category_links', 'category_id', 'ad_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_links', 'category_id');
    }

    public function regenerateBreadcrumb()
    {
        $breadcrumb = $this->name;

        if ($this->parent) {
            $breadcrumb = $this->parent->name . ' » ' . $breadcrumb;

            if ($this->parent->parent) {
                $breadcrumb = $this->parent->parent->name . ' » ' . $breadcrumb;
            }
        }

        $this->breadcrumb = $breadcrumb;
        $this->save();
    }

    public function regenerateChildrenBreadcrumbs()
    {
        $this->children
            ->each(function ($child) {
                $child->regenerateBreadcrumb();
                $child->regenerateChildrenBreadcrumbs();
            });
    }
}
