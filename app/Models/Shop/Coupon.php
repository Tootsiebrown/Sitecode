<?php

namespace App\Models\Shop;

use App\ProductCategory;
use Wax\Shop\Models\Coupon as WaxCoupon;

class Coupon extends WaxCoupon
{
    protected $fillable = [
        'title',
        'code',
        'expired_at',
        'dollars',
        'percent',
        'minimum_order',
        'one_time',
        'include_shipping',
        'permitted_uses',
        'category_id',
    ];

    public function getTypeAttribute()
    {
        return $this->dollars ? 'dollars' : 'percent';
    }

    public function getDiscountAttribute()
    {
        return $this->type == 'dollars' ? $this->dollars : $this->percent;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
