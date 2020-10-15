<?php

namespace App\Events;

use App\Bid;

class BidReceivedEvent
{
    public Bid $bid;

    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
    }
}
