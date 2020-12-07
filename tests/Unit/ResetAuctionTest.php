<?php

namespace Tests\Unit;

use App\Bid;
use App\Jobs\ResetAuction;
use App\Models\EndedAuction;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class ResetAuctionTest extends WaxAppTestCase
{
    /** @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed */
    private $endedAuction;

    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();

        $this->listing = factory(Listing::class)->create([
            'type' => 'auction',
            'expired_at' => Carbon::now()->subHours(25)->toDateTimeString(),
        ]);

        $this->user = factory(User::class)->create();
        $this->listing->bids()->save(new Bid(['user_id' => $this->user->id, 'bid_amount' => 500]));
        $this->endedAuction = factory(EndedAuction::class)->create(['listing_id' => $this->listing->id]);
    }

    public function testEndedAuctionDeleted()
    {
        $this->assertTrue($this->endedAuction->exists);

        $job = new ResetAuction($this->endedAuction);
        $job->handle();
        $this->endedAuction->refresh();

        $this->assertFalse($this->endedAuction->exists);
    }

    public function testEndedAuctionBidsDeleted()
    {
        $this->assertEquals(1, $this->endedAuction->listing->bids()->count());

        $job = new ResetAuction($this->endedAuction);
        $job->handle();

        $this->assertEquals(0, $this->endedAuction->listing->bids()->count());
    }

    public function testListingActive()
    {
        $this->assertFalse($this->listing->is_bidding_active);

        $job = new ResetAuction($this->endedAuction);
        $job->handle();
        $this->endedAuction->listing->refresh();

        $this->assertTrue($this->endedAuction->listing->is_bidding_active);
    }
}
