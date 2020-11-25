<?php

namespace App\Wax\Shop\Models;

use App\ProductCategory;
use App\Support\CouponInterface;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Wax\Shop\Models\Coupon as WaxCoupon;
use Wax\Shop\Models\Order;

class Coupon extends WaxCoupon implements CouponInterface
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
        'listing_id',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'uses' => 'integer',
        'permitted_uses' => 'integer',
        'one_time' => 'boolean',
        'category_id' => 'integer',
        'listing_id' => 'integer',
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

    public function validate(Order $order)
    {
        return (new OrderCouponValidator($order, $this))->passes();
    }
}
