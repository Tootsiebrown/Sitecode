<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Sub_Category
 *
 * @property int $id
 * @property string|null $category_name
 * @property string|null $category_slug
 * @property int|null $category_id
 * @property string|null $description
 * @property string|null $category_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $parentCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereCategoryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sub_Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Sub_Category extends Model
{
    protected $table = 'categories';

    public function parentCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_count()
    {
        return $this->hasMany(Listing::class, 'sub_category_id')->whereStatus('1')->count();
    }
}
