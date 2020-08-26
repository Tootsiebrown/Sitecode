<?php

namespace Tests\Unit;

use App\Ad;
use App\Events\AuctionEndedEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Tests\WaxAppTestCase;

class FireExpiredAuctionsEventsTestTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function testExpiredAuctionHandled()
    {
        $ad = factory(Ad::class)->create([
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

