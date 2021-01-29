<?php

namespace App\Models\Listing;

use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;
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
 * @method static Builder|Item available()
 * @method static Builder|Item availableForOrder($order)
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item notReserved()
 * @method static Builder|Item query()
 * @method static Builder|Item reserved()
 * @method static Builder|Item reservedForOffer($offerId)
 * @method static Builder|Item sold()
 * @mixin \Eloquent
 * @property-read EbayOrder|null $ebayOrder
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

    public function scopeForEbayOrder($query, $ebayOrderId)
    {
        return $query->where('ebay_order_id', $ebayOrderId);
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

    public function ebayOrder()
    {
        return $this->belongsTo(EbayOrder::class, 'ebay_order_id');
    }
}
