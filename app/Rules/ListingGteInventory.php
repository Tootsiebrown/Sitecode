<?php

namespace App\Rules;

use App\Models\Listing;
use Illuminate\Contracts\Validation\Rule;

class ListingGteInventory implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->listing->items()->count() >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is not enough inventory for this listing.';
    }
}
