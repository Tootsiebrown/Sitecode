<?php

namespace App\Wax\Shop\Models\Product;

use App\Wax\Shop\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Wax\Shop\Models\Product\Customization
 *
 * @property int $id
 * @property int $cms_sort_id
 * @property int $product_id
 * @property int $required
 * @property string $name
 * @property string $type
 * @property string $min
 * @property string $max
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|Customization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customization query()
 * @mixin \Eloquent
 */
class Customization extends Model
{
    protected $table = 'product_customization';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
