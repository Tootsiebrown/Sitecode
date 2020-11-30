<?php

namespace Tests\Unit;

use App\Bid;
use App\Events\AuctionEndedEvent;
use App\Jobs\NotifyWinner;
use App\Listeners\StartAuctionEndedChain;
use App\Mail\NotifyNoWinner as NotifyNoWinnerEmail;
use App\Mail\NotifyWinner as NotifyWinnerEmail;
use App\Models\EndedAuction;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class EndedAuctionCreationTest extends WaxAppTestCase
{
    public function testNoWinner()
    {
        $this->assertEquals(0, EndedAuction::count());

        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $event = new AuctionEndedEvent($listing);
        (new StartAuctionEndedChain())->handle($event);

        $this->assertEquals(0, EndedAuction::count());
    }

    public function testWinner()
    {
        $this->assertEquals(0, EndedAuction::count());

        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $user = factory(User::class)->create();

        $listing->bids()->save(new Bid(['user_id' => $user->id, 'bid_amount' => 27]));

        $event = new AuctionEndedEvent($listing);
        (new StartAuctionEndedChain())->handle($event);

        $this->assertEquals(1, EndedAuction::count());

        $this->assertEquals($listing->id, EndedAuction::first()->listing->id);
    }
}

