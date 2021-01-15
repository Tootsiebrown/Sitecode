<?php

namespace App;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Bid
 *
 * @property int $id
 * @property int|null $listing_id
 * @property int|null $user_id
 * @property string|null $bid_amount
 * @property int|null $is_accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $is_mine
 * @property-read Listing|null $listing
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Bid mine()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereBidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereIsAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUserId($value)
 * @mixin \Eloquent
 */
class Bid extends Model
{
    protected $guarded = [];

    public function posting_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        return $created_date_time;
    }

    public function getIsMineAttribute()
    {
        return Auth::check() && Auth::user()->id == $this->user_id;
    }

    public function scopeMine($query)
    {
        if (! Auth::check()) {
            return $query->whereRaw('1=0');
        }

        return $query->where('user_id', Auth::user()->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class)->withoutGlobalScopes();
    }
}
