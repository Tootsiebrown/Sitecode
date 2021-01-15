<?php

namespace App;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property int|null $ad_id
 * @property int|null $user_id
 * @property string|null $amount
 * @property string|null $payment_method
 * @property string|null $status
 * @property string|null $currency
 * @property string|null $token_id
 * @property string|null $card_last4
 * @property string|null $card_id
 * @property string|null $client_ip
 * @property string|null $charge_id_or_token
 * @property string|null $payer_email
 * @property string|null $description
 * @property string|null $local_transaction_id
 * @property int|null $payment_created
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Listing|null $ad
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @mixin \Eloquent
 */
class Payment extends Model
{
    protected $guarded = [];

    public function ad()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function created_at_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        return $created_date_time;
    }

    public function payment_completed_at()
    {
        $created_date_time = '';
        if ($this->payment_created) {
            $created_date_time = Carbon::createFromTimestamp($this->payment_created, get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));
        }
        return $created_date_time;
    }
}
