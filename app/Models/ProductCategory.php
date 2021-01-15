<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductCategory
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Model
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @property-read int|null $products_count
 * @method static Builder|ProductCategory hasListings()
 * @method static Builder|ProductCategory newModelQuery()
 * @method static Builder|ProductCategory newQuery()
 * @method static Builder|ProductCategory query()
 * @method static Builder|ProductCategory top()
 * @method static Builder|ProductCategory whereBreadcrumb($value)
 * @method static Builder|ProductCategory whereCmsSortId($value)
 * @method static Builder|ProductCategory whereCreatedAt($value)
 * @method static Builder|ProductCategory whereDeletedAt($value)
 * @method static Builder|ProductCategory whereDescription($value)
 * @method static Builder|ProductCategory whereHandler($value)
 * @method static Builder|ProductCategory whereId($value)
 * @method static Builder|ProductCategory whereImage($value)
 * @method static Builder|ProductCategory whereImageMetadata($value)
 * @method static Builder|ProductCategory whereName($value)
 * @method static Builder|ProductCategory whereParentId($value)
 * @method static Builder|ProductCategory whereShortDescription($value)
 * @method static Builder|ProductCategory whereUpdatedAt($value)
 * @method static Builder|ProductCategory whereUrlLock($value)
 * @method static Builder|ProductCategory whereUrlSlug($value)
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
