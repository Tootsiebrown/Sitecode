<?php

namespace Tests\Unit;

use App\Ebay\Sdk;
use App\Jobs\CreateEbayOffer;
use App\Jobs\SendListingToEbay;
use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class SendListingToEbayFailureTest extends WaxAppTestCase
{
    private $mockOrderId = 369;

    public function setUp(): void
    {
        parent::setUp();

        $this->ebay = $this->getMockBuilder(Sdk::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ebay
            ->method('createInventoryItem')
            ->will($this->throwException(new \Exception()));

        Queue::fake();

        $this->listing = factory(Listing::class)->create();
    }

    public function testExceptionThrown()
    {
        $this->expectException(\Exception::class);

        $job = new SendListingToEbay($this->listing);
        $job->handle($this->ebay);
$this->assertTrue(false);
        Queue::assertNotPushed(CreateEbayOffer::class);
    }

    public function testExceptionRecordedOnListingRecord()
    {
        try {
            $job = new SendListingToEbay($this->listing);
            $job->handle($this->ebay);
        } catch (\Exception $e) {
            // just suppress it.
        }

        $this->listing->refresh();

        $this->assertNotNull($this->listing->to_ebay_error_at);
        Queue::assertNotPushed(CreateEbayOffer::class);
    }
}

