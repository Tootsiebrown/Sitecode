<?php

namespace Tests\Unit;

use App\Listeners\SendAuctionEndedNotification;
use App\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
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
    }

    public function testEventHandled()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        $listener = Mockery::spy(SendAuctionEndedNotification::class);
        app()->instance(SendAuctionEndedNotification::class, $listener);

        Artisan::call('auction:process-ended');

        $listener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) use ($listing) {
                return $event->listing->id === $listing->id;
            }))
            ->once();
    }
}

