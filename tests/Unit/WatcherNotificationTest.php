<?php

namespace Tests\Unit;

use App\Events\AuctionEndedEvent;
use App\Jobs\NotifyWatchers;
use App\Listeners\SendAuctionEndedNotification;
use App\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class WatcherNotificationTest extends WaxAppTestCase
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $shopService;

    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();

        $this->shopService = app(ShopService::class);
    }

    public function testEventHandled()
    {
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
            'type' => 'auction',
            'price' => 25,
        ]);

        (new SendAuctionEndedNotification())->handle(new AuctionEndedEvent($listing));

        Queue::assertPushed(NotifyWatchers::class, function ($job) use ($listing) {
            return $job->listing->id === $listing->id;
        });
    }
}

