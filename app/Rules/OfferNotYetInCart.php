<?php

namespace App\Rules;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Wax\Shop\Facades\ShopServiceFacade;

class OfferNotYetInCart implements Rule
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

        $alreadyInCart = ShopServiceFacade::getActiveOrder()
            ->default_shipment
            ->items
            ->filter(function ($item) use ($offer) {
                return $item
                    ->customizations
                    ->filter(function ($customization) use ($offer) {
                        return $customization->customization == 2
                            && $customization->value == $offer->id;
                    })
                    ->count() > 0;
            })
            ->count() > 0;

        return ! $alreadyInCart;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'An offer cannot be put in the cart twice.';
    }
}
