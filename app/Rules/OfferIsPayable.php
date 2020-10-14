<?php

namespace App\Rules;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class OfferIsPayable implements Rule
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
        $offer = Offer::withoutGlobalScopes()->find($value);

        if (! $offer) {
            return false;
        }

        if ($offer->status !== 'accepted' && $offer->status !== 'counter_accepted') {
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
        return 'This offer has not been accepted, or it has expired.';
    }
}
