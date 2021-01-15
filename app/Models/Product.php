<?php

namespace App\Models;

use App\HasCondition;
use App\HasProductCategories;
use App\ProductImage;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $brand_id
 * @property string|null $upc
 * @property string $name
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string|null $features
 * @property string|null $description
 * @property string|null $price
 * @property string|null $color
 * @property string|null $gender
 * @property string|null $model_number
 * @property string|null $original_price
 * @property string $condition
 * @property string|null $size
 * @property string|null $expiration_date
 * @property string|null $dimensions
 * @property float|null $shipping_weight_oz
 * @property \Illuminate\Support\Carbon|null $redone_at
 * @property int|null $redone_by_user_id
 * @property int $offers_enabled
 * @property-read \Illuminate\Database\Eloquent\Collection|Listing[] $ads
 * @property-read int|null $ads_count
 * @property-read \App\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $category
 * @property-read mixed $child_category
 * @property-read mixed $ebay_condition_enum
 * @property-read mixed $featured_image
 * @property-read mixed $grandchild_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \App\User|null $redoneBy
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimensions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFeatures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereModelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOffersEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRedoneAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRedoneByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShippingWeightOz($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
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
            ->orderBy('sort_id');
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
