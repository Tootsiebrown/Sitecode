<?php

namespace App\Events;

use App\Models\Offer;

class OfferCounterExpiredEvent
{
    public $offer;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }
}
