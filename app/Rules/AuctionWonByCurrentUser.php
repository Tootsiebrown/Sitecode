<?php

namespace App\Rules;

use App\Ad;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuctionWonByCurrentUser implements Rule
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

        if (!$ad->winning_bid) {
            return false;
        }

        if ($ad->winning_bid->user_id != Auth::user()->id) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not an auction that you won.';
    }
}
