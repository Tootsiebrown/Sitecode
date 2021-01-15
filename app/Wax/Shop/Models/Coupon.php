<?php

namespace App\Wax\Shop\Models;

use App\Models\ProductCategory;
use App\Support\CouponInterface;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Wax\Shop\Models\Coupon as WaxCoupon;
use Wax\Shop\Models\Order;

/**
 * App\Wax\Shop\Models\Coupon
 *
 * @property int $id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $expired_at
 * @property string|null $title
 * @property string|null $dollars
 * @property int|null $percent
 * @property string|null $minimum_order
 * @property bool $one_time
 * @property int $include_shipping
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $uses
 * @property int|null $permitted_uses
 * @property int|null $category_id
 * @property int|null $listing_id
 * @property-read ProductCategory|null $category
 * @property-read mixed $discount
 * @property-read mixed $type
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDollars($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIncludeShipping($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMinimumOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOneTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon wherePermittedUses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUses($value)
 * @mixin \Eloquent
 */
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
