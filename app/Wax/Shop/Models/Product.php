<?php

namespace App\Wax\Shop\Models;

use Wax\Shop\Models\Product as WaxProduct;
use App\Wax\Shop\Models\Product\Customization;

class Product extends WaxProduct
{
    protected $table = 'wax_products';
    protected $guarded = [];

    public function customizations()
    {
        return $this->hasMany(Customization::class);
    }

    public function getEffectiveInventoryAttribute()
    {
        return 1000;
    }

    public function images()
    {
        return collect();
    }
}
