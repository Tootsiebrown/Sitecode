<?php

namespace App\Rules;

use App\Ad;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuctionIsPayable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value the ID of the auction
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ad = Ad::find($value);

        if (! $ad) {
            return false;
        }

        if ($ad->is_bid_active()) {
            return false;
        }

        if (! $ad->is_bid_accepted()) {
            return false;
        }

        // @todo check to make sure the listing hasn't been paid for on another order.

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not an auction that is ready for payment.';
    }
}