<?php

namespace Tests\Unit;

use App\Bid;
use App\Jobs\ResetAuction;
use App\Mail\NotifyWinnerPaymentNeeded;
use App\Models\EndedAuction;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class ProcessUnpaidAuctionsNeedingResetTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();

        $this->listing = factory(Listing::class)->create([
            'type' => 'auction',
            'expired_at' => Carbon::now()->subHours(25)->toDateTimeString(),
        ]);
    }

    public function testNoEndedAuctions()
    {
        Artisan::call('auction:process-resets');
        Queue::assertNotPushed(RelistAuction::class);
    }

    public function testNoAuctionEndedOver24HoursAgo()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(23)->toDateTimeString(),
            'listing_id' => $this->listing->id,
        ]);

        Artisan::call('auction:process-resets');
        Queue::assertNotPushed(RelistAuction::class);
    }

    public function testAuctionEndedButWasAlreadyPaidfor()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(25)->toDateTimeString(),
            'listing_id' => $this->listing->id,
            'purchased_at' => Carbon::now()->subHours(23)->toDateTimeString()
        ]);

        Artisan::call('auction:process-resets');
        Queue::assertNotPushed(RelistAuction::class);
    }

    public function testAuctionNeedsReset()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(25)->toDateTimeString(),
            'listing_id' => $this->listing->id,
        ]);

        $user = factory(User::class)->create();
        $this->listing->bids()->save(new Bid(['user_id' => $user->id, 'bid_amount' => 500]));

        Artisan::call('auction:process-resets');
        Queue::assertPushed(ResetAuction::class, function ($job) {
            return $job->endedAuction->listing->id == $this->listing->id;
        });
    }
}
