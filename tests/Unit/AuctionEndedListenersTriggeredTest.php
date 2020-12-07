<?php

namespace Tests\Unit;

use App\Listeners\SendAuctionEndedNotification;
use App\Listeners\StartAuctionEndedChain;
use App\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\WaxAppTestCase;

class AuctionEndedListenersTriggeredTest extends WaxAppTestCase
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $shopService;

    public function setUp(): void
    {
        parent::setUp();
        Mail::fake();
    }

    public function testNotificationListenerCalled()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $notificationsListener = Mockery::spy(SendAuctionEndedNotification::class);
        app()->instance(SendAuctionEndedNotification::class, $notificationsListener);

        Artisan::call('auction:process-ended');

        $notificationsListener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) use ($listing) {
                return $event->listing->id === $listing->id;
            }))
            ->once();
    }

    public function testEndingChainCalled()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $endedAuctionChainListener = Mockery::spy(StartAuctionEndedChain::class);
        app()->instance(StartAuctionEndedChain::class, $endedAuctionChainListener);

        Artisan::call('auction:process-ended');

        $endedAuctionChainListener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) use ($listing) {
                return $event->listing->id === $listing->id;
            }))
            ->once();
    }
}

