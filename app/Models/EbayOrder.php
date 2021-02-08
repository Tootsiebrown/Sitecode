<?php

namespace App\Models;

use App\Models\Listing\Item;
use App\Models\Traits\HandlesCancelingOrders;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\EbayOrder
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $ebay_id
 * @property int|null $canceled_by_user_id
 * @property string|null $canceled_at
 * @property-read User|null $canceledBy
 * @property-read mixed $canceled
 * @property-read Collection|Item[] $items
 * @property-read int|null $items_count
 * @method static Builder|EbayOrder newModelQuery()
 * @method static Builder|EbayOrder newQuery()
 * @method static Builder|EbayOrder query()
 * @mixin \Eloquent
 * @property string|null $transaction_id
 * @property string|null $shipped_at
 * @method static Builder|EbayOrder forOrderProcessingReport()
 */
class EbayOrder extends Model
{
    use HandlesCancelingOrders;

    protected $guarded = [];
    public $timestamps = true;

    public function scopeForOrderProcessingReport($query)
    {
        return $query->whereNotNull('transaction_id')
            ->whereNotNull('ebay_id')
            ->whereNull('canceled_at')
            ->whereNull('shipped_at');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'ebay_order_id');
    }

    public function isPending()
    {
        return is_null($this->ebay_id);
    }

    public function getStatusAttribute()
    {
        if ($this->canceled_at) {
            return 'CANCELED';
        }

        if ($this->isPending()) {
            return 'PENDING';
        }

        if (!is_null($this->shipped_at)) {
            return 'SHIPPED';
        }

        return 'PAID';
    }
}
