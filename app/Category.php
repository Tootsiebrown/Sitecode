<?php

namespace App;

use App\Models\Brand;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property int $id
 * @property string|null $category_name
 * @property string|null $category_slug
 * @property int|null $category_id
 * @property string|null $description
 * @property string|null $category_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Listing[] $ads
 * @property-read int|null $ads_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Brand[] $brands
 * @property-read int|null $brands_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Sub_Category[] $sub_categories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $guarded = [];

    public function ads()
    {
        return $this->hasMany(Listing::class);
    }
    public function sub_categories()
    {
        return $this->hasMany('App\Sub_Category')->orderBy('category_name', 'asc');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function product_count()
    {
        return $this->hasMany(Listing::class)->whereStatus('1')->count();
    }
}
