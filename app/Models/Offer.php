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
 * App\Models\Offer
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property int $listing_id
 * @property int $quantity
 * @property string $price
 * @property Carbon|null $responded_at
 * @property string|null $response
 * @property int|null $counter_quantity
 * @property string|null $counter_price
 * @property string|null $response_message
 * @property string|null $counter_responded_at
 * @property int|null $counter_accepted
 * @property string|null $purchased_at
 * @property int $expired_event_fired
 * @property-read mixed $pretty_status
 * @property-read mixed $status
 * @property-read \App\Models\Listing $listing
 * @property-read User $user
 * @method static Builder|Offer expirationEventNotFired()
 * @method static Builder|Offer forListing(\App\Models\Listing $listing)
 * @method static Builder|Offer mine()
 * @method static Builder|Offer newModelQuery()
 * @method static Builder|Offer newQuery()
 * @method static Builder|Offer query()
 * @method static Builder|Offer status($status)
 * @mixin \Eloquent
 */
class Offer extends Model
{
    protected $guarded = [];
    protected $dates = [
        'responded_at',
    ];

    public function scopeMine(Builder $query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeForListing(Builder $query, Listing $listing)
    {
        return $query->where('listing_id', $listing->id);
    }

    public function scopeStatus(Builder $query, $status)
    {
        switch ($status) {
            case 'purchased':
                return $query->whereNotNull('purchased_at');
                break;
            case 'counter_expired':
                return $query
                    ->where('responded_at', '<', Carbon::now()->subHours(24)->toDateTimeString())
                    ->where('response', 'countered')
                    ->where(function ($query) {
                        $query->orWhere('counter_accepted', true)
                            ->orWhereNull('counter_accepted');
                    })
                    ->whereNull('purchased_at');
                break;
            case 'countered':
                return $query
                    ->whereNull('counter_responded_at')
                    ->where('responded_at', '>', Carbon::now()->subHours(24)->toDateTimeString())
                    ->where('response', 'countered');
                break;
            case 'counter_accepted':
                return $query
                    ->where('responded_at', '>', Carbon::now()->subHours(24)->toDateTimeString())
                    ->whereNotNull('purchased_at')
                    ->where('counter_accepted', true);
                break;
            case 'counter_rejected':
                return $query
                    ->where('counter_accepted', false);
                break;
            case 'expired':
                return $query
                    ->where('responded_at', '<', Carbon::now()->subHours(24)->toDateTimeString())
                    ->where('response', 'accepted')
                    ->whereNull('purchased_at');
            case 'accepted':
                return $query
                    ->where('responded_at', '>', Carbon::now()->subHours(24)->toDateTimeString())
                    ->where('response', 'accepted')
                    ->whereNull('purchased_at');
                break;
            case 'pending':
                return $query->whereNull('responded_at');
                break;
            case 'rejected':
                return $query->where('response', 'rejected');
                break;
        }
    }

    public function scopeExpirationEventNotFired(Builder $query)
    {
        return $query->where('expired_event_fired', false);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class)->withoutGlobalScopes();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPrettyStatusAttribute()
    {
        return Str::title(str_replace('_', ' ', $this->status));
    }

    public function getStatusAttribute()
    {
        if ($this->purchased_at) {
            return 'purchased';
        }

        if ($this->counter_responded_at) {
            if (! $this->counter_accepted) {
                return 'counter_rejected';
            } else {
                if ($this->responded_at->wasOver24HoursAgo()) {
                    return 'counter_expired';
                } else {
                    return 'counter_accepted';
                }
            }
        }

        if (! $this->responded_at) {
            return 'pending';
        }

        if ($this->responded_at->wasOver24HoursAgo()) {
            return 'expired';
        }

        return $this->response;
    }

    public function accept()
    {
        DB::transaction(function () {
            $numberOfRowsAffected = $this
                ->listing->items()->available()
                ->limit($this->quantity)
                ->update(['reserved_for_offer_id' => $this->id]);

            if ($numberOfRowsAffected !== $this->quantity) {
                throw ValidationException::withMessages(['error' => 'Insufficient Inventory for ' . $this->listing->title]);
            }

            $this->responded_at = Carbon::now()->toDateTimeString();
            $this->response = 'accepted';
            $this->save();
        }, 3);
    }

    public function reject()
    {
        $this->responded_at = Carbon::now()->toDateTimeString();
        $this->response = 'rejected';
        $this->save();
    }

    public function counter(array $input)
    {
        DB::transaction(function () use ($input) {
            $numberOfRowsAffected = $this
                ->listing->items()->available()
                ->limit($this->quantity)
                ->update(['reserved_for_offer_id' => $this->id]);

            if ($numberOfRowsAffected !== $this->quantity) {
                throw ValidationException::withMessages(['error' => 'Insufficient Inventory for ' . $this->listing->title]);
            }

            $this->counter_quantity = $input['counter_quantity'];
            $this->counter_price = $input['counter_price'];
            $this->response = 'countered';
            $this->responded_at = Carbon::now()->toDateTimeString();
            $this->save();
        }, 3);
    }

    public function customerAccept()
    {
        DB::transaction(function () {
            $verifiedInventory = $this
                ->listing->items()->reservedForOffer($this->id)
                ->limit($this->counter_quantity)
                ->count();

            if ($verifiedInventory !== $this->counter_quantity) {
                throw ValidationException::withMessages(['inventory' => 'Insufficient Inventory for ' . $this->listing->title]);
            }

            $this->counter_responded_at = Carbon::now()->toDateTimeString();
            $this->counter_accepted = 1;
            $this->save();
        }, 3);
    }

    public function customerReject()
    {
        DB::transaction(function () {
            $this
                ->listing
                ->items()
                ->reservedForOffer($this->id)
                ->update(['reserved_for_offer_id' => null]);

            $this->counter_responded_at = Carbon::now()->toDateTimeString();
            $this->counter_accepted = 0;
            $this->save();
        }, 3);
    }

    public function markPurchased()
    {
        $this->purchased_at = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
