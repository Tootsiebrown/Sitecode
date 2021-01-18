<?php

namespace Tests\Unit;

use App\Ebay\Sdk;
use App\Jobs\CreateOrUpdateOffer;
use App\Jobs\Ebay\PublishOffer;
use App\Jobs\SendListingToEbay;
use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class CreateEbayOfferTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->ebay = $this->getMockBuilder(Sdk::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ebay
            ->method('createOffer')
            ->willReturn('1234');

        Queue::fake();

        $this->listing = factory(Listing::class)->create();
    }

    public function testNormalSuccess()
    {
        $job = new CreateOrUpdateOffer($this->listing);
        $job->handle($this->ebay);

        $this->listing->refresh();

        $this->assertEquals('1234', $this->listing->ebay_offer_id);
        Queue::assertPushed(PublishOffer::class);
    }
}

