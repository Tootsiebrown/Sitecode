<?php

namespace Tests\Unit;

use App\Events\AuctionEndedEvent;
use App\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Tests\WaxAppTestCase;

class FireExpiredAuctionsEventsTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function testExpiredAuctionHandled()
    {
        $ad = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
        ]);

        Artisan::call('auction:process-ended');

        Event::assertDispatched(AuctionEndedEvent::class, function($event) use ($ad) {
            return $event->ad_id = $ad->id;
        });

        $ad->refresh();
        $this->assertEquals(true, $ad->end_event_fired);
    }

}

