<?php

namespace App\Wax\Shop\Models;

use Wax\Shop\Models\Product as WaxProduct;
use App\Wax\Shop\Models\Product\Customization;

/**
 * App\Wax\Shop\Models\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $brand
 * @property string|null $model
 * @property string $name
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property string $description
 * @property string $short_description
 * @property int $active
 * @property string $msrp
 * @property string $price
 * @property string $weight
 * @property string $dim_l
 * @property string $dim_w
 * @property string $dim_h
 * @property int $inventory
 * @property int $featured
 * @property int $taxable
 * @property int $discountable
 * @property int $one_per_user
 * @property string $sku
 * @property string|null $rating
 * @property int $rating_count
 * @property int $shipping_enable_rate_lookup
 * @property string $shipping_flat_rate
 * @property int $shipping_disable_free_shipping
 * @property int $shipping_enable_tracking_number
 * @property int|null $category_id
 * @property string|null $url_slug
 * @property int $url_lock
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Product\Attribute[] $attrs
 * @property-read int|null $attrs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Bundle[] $bundles
 * @property-read int|null $bundles_count
 * @property-read \Wax\Shop\Models\Product\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|Customization[] $customizations
 * @property-read int|null $customizations_count
 * @property-read mixed $default_image
 * @property-read mixed $effective_inventory
 * @property-read mixed $meta_title
 * @property-read mixed $options
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Product\OptionModifier[] $optionModifiers
 * @property-read int|null $option_modifiers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Product\OptionValue[] $optionValues
 * @property-read int|null $option_values_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Wax\Shop\Models\Product\Option[] $rawOptions
 * @property-read int|null $raw_options_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $relatedProducts
 * @property-read int|null $related_products_count
 * @method static Builder|Product featured()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimH($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDimW($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereInventory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMsrp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOnePerUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRatingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShippingDisableFreeShipping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShippingEnableRateLookup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShippingEnableTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShippingFlatRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTaxable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrlLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrlSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 * @mixin \Eloquent
 */
class Product extends WaxProduct
{
    protected $table = 'wax_products';
    protected $guarded = [];

    public function customizations()
    {
        return $this->hasMany(Customization::class);
    }

    public function images()
    {
        return collect();
    }
}
