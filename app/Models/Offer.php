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

class Offer extends Model
{
    protected $guarded = [];

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
            case 'accepted':
                return $query
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
        if (! $this->responded_at) {
            return 'pending';
        }

        if ($this->response === 'countered') {
            if (! $this->counter_responded_at) {
                return 'countered';
            } else {
                return $this->counter_accepted
                    ? 'counter_accepted'
                    : 'counter_rejected';
            }
        }

        if ($this->purchased_at) {
            return 'purchased';
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
        });
    }

    public function reject()
    {
        $this->responded_at = Carbon::now()->toDateTimeString();
        $this->response = 'rejected';
        $this->save();
    }

    public function counter(array $input)
    {
        $this->counter_quantity = $input['counter_quantity'];
        $this->counter_price = $input['counter_price'];
        $this->response = 'countered';
        $this->responded_at = Carbon::now()->toDateTimeString();
        $this->save();
    }

    public function customerAccept()
    {
        DB::transaction(function () {
            $numberOfRowsAffected = $this
                ->listing->items()->available()
                ->limit($this->counter_quantity)
                ->update(['reserved_for_offer_id' => $this->id]);

            if ($numberOfRowsAffected !== $this->counter_quantity) {
                throw ValidationException::withMessages(['error' => 'Insufficient Inventory for ' . $this->listing->title]);
            }

            $this->counter_responded_at = Carbon::now()->toDateTimeString();
            $this->counter_accepted = 1;
            $this->save();
        });
    }

    public function customerReject()
    {
        $this->counter_responded_at = Carbon::now()->toDateTimeString();
        $this->counter_accepted = 0;
        $this->save();
    }

    public function markPurchased()
    {
        $this->purchased_at = Carbon::now()->toDateTimeString();
        $this->save();
    }
}
