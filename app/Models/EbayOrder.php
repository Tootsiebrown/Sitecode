<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
