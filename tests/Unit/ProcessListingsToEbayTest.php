<?php

namespace Tests\Unit;

use App\Jobs\SendListingToEbay;
use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class ProcessListingsToEbayTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow("2020-12-14 13:00:00");
        Queue::fake();
        $this->listing = factory(Listing::class)->create([
            'type' => 'set-price',
            'send_to_ebay_days' => 3,
        ]);

        $this->listing->items()->saveMany(factory(ListingItem::class, 3)->make());
    }

    public function testNoReadyListings()
    {
        Artisan::call('ebay:process-ready-listings');
        Queue::assertNotPushed(SendListingToEbay::class);
    }

    public function testListingReady()
    {
        Carbon::setTestNow(Carbon::now()->addDays(4)->setHour(23));
        Artisan::call('ebay:process-ready-listings');
        Queue::assertPushed(SendListingToEbay::class);
    }

    public function testListingAlreadySent()
    {
        $this->listing->sent_to_ebay_at = Carbon::now()->toDateTimeString();
        $this->listing->save();

        Carbon::setTestNow(Carbon::now()->addDays(4));
        Artisan::call('ebay:process-ready-listings');
        Queue::assertNotPushed(SendListingToEbay::class);
    }
}
