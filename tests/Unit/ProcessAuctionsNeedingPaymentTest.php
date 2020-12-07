<?php

namespace Tests\Unit;

use App\Bid;
use App\Mail\NotifyWinnerPaymentNeeded;
use App\Models\EndedAuction;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Tests\WaxAppTestCase;

class ProcessAuctionsNeedingPaymentTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        $this->listing = factory(Listing::class)->create([
            'type' => 'auction',
            'expired_at' => Carbon::now()->toDateTimeString(),
        ]);
    }

    public function testNoEndedAuctions()
    {
        Artisan::call('auction:process-needing-payment');
        Mail::assertNotQueued(NotifyWinnerPaymentNeeded::class);
    }

    public function testNoAuctionEndedOverTwelveHoursAgo()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(10)->toDateTimeString(),
            'listing_id' => $this->listing->id,
        ]);

        Artisan::call('auction:process-needing-payment');
        Mail::assertNotQueued(NotifyWinnerPaymentNeeded::class);
    }

    public function testAuctionEndedButWasAlreadyPaidfor()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(13)->toDateTimeString(),
            'listing_id' => $this->listing->id,
            'purchased_at' => Carbon::now()->toDateTimeString()
        ]);

        Artisan::call('auction:process-needing-payment');
        Mail::assertNotQueued(NotifyWinnerPaymentNeeded::class);
    }

    public function testAuctionNeedsReminderSent()
    {
        $endedAuction = factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(13)->toDateTimeString(),
            'listing_id' => $this->listing->id,
        ]);

        $user = factory(User::class)->create();
        $this->listing->bids()->save(new Bid(['user_id' => $user->id, 'bid_amount' => 500]));

        Artisan::call('auction:process-needing-payment');
        Mail::assertQueued(NotifyWinnerPaymentNeeded::class, function ($mailable) {
            return $mailable->listing->id === $this->listing->id;
        });

        $endedAuction->refresh();
        $this->assertNotNull($endedAuction->reminder_sent_at);
    }

    public function testAuctionReminderAlreadySent()
    {
        factory(EndedAuction::class)->create([
            'created_at' => Carbon::now()->subHours(13)->toDateTimeString(),
            'listing_id' => $this->listing->id,
            'reminder_sent_at' => Carbon::now()->subHour()->toDateTimeString(),
        ]);

        $user = factory(User::class)->create();
        $this->listing->bids()->save(new Bid(['user_id' => $user->id, 'bid_amount' => 500]));

        Artisan::call('auction:process-needing-payment');
        Mail::assertNotQueued(NotifyWinnerPaymentNeeded::class);
    }
}
