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
        $listing = factory(Listing::class)->create([
            'expired_at' => Carbon::now()->subMinute(),
        ]);

        Artisan::call('auction:process-ended');

        Event::assertDispatched(AuctionEndedEvent::class, function($event) use ($listing) {
            return $event->listing->id = $listing->id;
        });

        $listing->refresh();
        $this->assertEquals(true, $listing->end_event_fired);
    }

}

