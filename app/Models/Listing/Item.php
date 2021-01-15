<?php

namespace App\Models\Listing;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Wax\Shop\Models\Order\Item as OrderItem;

/**
 * App\Models\Listing\Item
 *
 * @property int $id
 * @property int $listing_id
 * @property int|null $order_item_id
 * @property string|null $bin
 * @property int|null $reserved_for_order_id
 * @property string|null $removed_at
 * @property int|null $reserved_for_offer_id
 * @property int|null $ebay_order_id
 * @property-read mixed $removed
 * @property-read Listing $listing
 * @property-read OrderItem|null $orderItem
 * @method static \Illuminate\Database\Eloquent\Builder|Item available()
 * @method static \Illuminate\Database\Eloquent\Builder|Item availableForOrder($order)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item notReserved()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item reserved()
 * @method static \Illuminate\Database\Eloquent\Builder|Item reservedForOffer($offerId)
 * @method static \Illuminate\Database\Eloquent\Builder|Item sold()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereEbayOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereOrderItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRemovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereReservedForOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereReservedForOrderId($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    public $timestamps = false;
    protected $table = 'listing_items';

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id')->withoutGlobalScopes();
    }

    public function scopeAvailable($query)
    {
        return $query
            ->whereNull('order_item_id')
            ->whereNull('reserved_for_offer_id')
            ->whereNull('reserved_for_order_id')
            ->whereNull('ebay_order_id');
    }

    public function scopeAvailableForOrder($query, $order)
    {
        return $query->where(function ($query) use ($order) {
            $query
                ->orWhere(function ($query) {
                    $query->available();
                })
                ->orWhere(function ($query) use ($order) {
                    $query
                        ->where('reserved_for_order_id', $order->id)
                        ->whereNull('reserved_for_offer_id')
                        ->whereNull('order_item_id');
                });
        });
    }

    public function scopeSold($query)
    {
        return $query->whereNotNull('order_item_id');
    }

    public function scopeReserved($query)
    {
        return $query
            ->where(function ($query) {
                $query
                    ->orWhereNotNull('reserved_for_order_id')
                    ->orWhereNotNull('reserved_for_offer_id');
            });
    }

    public function scopeReservedForOffer($query, $offerId)
    {
        return $query->where('reserved_for_offer_id', $offerId);
    }

    public function scopeNotReserved($query)
    {
        return $query
            ->whereNull('reserved_for_order_id')
            ->whereNull('reserved_for_offer_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function getRemovedAttribute()
    {
        return !is_null($this->removed_at);
    }

    public function toggleRemoved()
    {
        if ($this->removed) {
            $this->removed_at = null;
        } else {
            $this->removed_at = Carbon::now()->toDateTimeString();
        }

        $this->save();
    }
}
