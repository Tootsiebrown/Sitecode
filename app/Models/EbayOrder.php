<?php

namespace App\Models;

use App\Models\Listing\Item;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|Item[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|EbayOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EbayOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EbayOrder query()
 * @mixin \Eloquent
 */
class EbayOrder extends Model
{
    protected $guarded = [];
    public $timestamps = true;

    public function getCanceledAttribute()
    {
        return !is_null($this->canceled_at);
    }

    public function cancel()
    {
        DB::table('listing_items')
            ->where('ebay_order_id', $this->id)
            ->update([
                'reserved_for_order_id' => null,
                'order_item_id' => null,
                'removed_at' => null,
                'reserved_for_offer_id' => null,
                'ebay_order_id' => null,
            ]);

        $this->canceled_by_user_id = Auth::user()->id;
        $this->canceled_at = Carbon::now()->toDateTimeString();
        $this->save();
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by_user_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'ebay_order_id');
    }
}
