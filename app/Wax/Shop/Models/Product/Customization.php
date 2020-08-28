<?php

namespace App\Wax\Shop\Models\Product;

use App\Wax\Shop\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    protected $table = 'product_customization';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
