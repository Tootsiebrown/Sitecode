<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * App\Models\EndedAuction
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $listing_id
 * @property string|null $reminder_sent_at
 * @property string|null $purchased_at
 * @property-read \App\Models\Listing $listing
 * @method static Builder|EndedAuction newModelQuery()
 * @method static Builder|EndedAuction newQuery()
 * @method static Builder|EndedAuction query()
 * @method static Builder|EndedAuction whereCreatedAt($value)
 * @method static Builder|EndedAuction whereId($value)
 * @method static Builder|EndedAuction whereListingId($value)
 * @method static Builder|EndedAuction wherePurchasedAt($value)
 * @method static Builder|EndedAuction whereReminderSentAt($value)
 * @method static Builder|EndedAuction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EndedAuction extends Model
{
    protected $guarded = [];

    public function listing()
    {
        return $this->belongsTo(Listing::class)->withoutGlobalScopes();
    }

    public function markPurchased()
    {
        $this->purchased_at = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
