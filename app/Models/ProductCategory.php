<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductCategory
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string|null $handler
 * @property string|null $breadcrumb
 * @property string|null $description
 * @property string|null $short_description
 * @property string|null $image
 * @property string|null $image_metadata
 * @property int $cms_sort_id
 * @property string|null $url_slug
 * @property int $url_lock
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read mixed $all_descendants
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|Listing[] $listings
 * @property-read int|null $listings_count
 * @property-read ProductCategory $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|ProductCategory hasListings()
 * @method static Builder|ProductCategory newModelQuery()
 * @method static Builder|ProductCategory newQuery()
 * @method static Builder|ProductCategory query()
 * @method static Builder|ProductCategory top()
 * @mixin \Eloquent
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

    public function getAllDescendantsAttribute()
    {
        $this->load('children.children');

        $children = $this->children;

        $grandchildren = $this->children
            ->map(function ($child) {
                return $child->children;
            })
            ->filter()
            ->flatten();

        return $children->merge($grandchildren);
    }

    public function getDescendentOfSecretAttribute()
    {
        if ($this->parent_id === 0) {
            return false;
        }

        if ($this->parent->secret) {
            return true;
        }

        // `$this->parent->parent_id !== 0` is to reduce the number of junk queries
        if ($this->parent->parent_id !== 0 && $this->parent->parent && $this->parent->parent->secret) {
            return true;
        }

        return false;
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
            'category' => $this->secret || $this->descendent_of_secret
                ? $this->secret_key
                : $this->id
        ]);
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class, 'ad_category_links', 'category_id', 'ad_id');
    }

    public function listingsWithSecret()
    {
        return $this
            ->belongsToMany(Listing::class, 'ad_category_links', 'category_id', 'ad_id')
            ->withoutGlobalScope('notSecret');
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
