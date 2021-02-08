<?php

namespace App\Events;

use App\Models\Listing;

class InventoryChangedEvent
{
    /** @var Listing */
    public Listing $listing;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }
}
