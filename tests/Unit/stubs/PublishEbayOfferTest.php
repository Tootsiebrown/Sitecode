<?php

namespace Tests\Unit;

use App\Ebay\Sdk;
use App\Jobs\CreateEbayOffer;
use App\Jobs\PublishEbayOffer;
use App\Jobs\SendListingToEbay;
use App\Models\EbayOrder;
use App\Models\Listing;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class PublishEbayOfferTest extends WaxAppTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->ebay = $this->getMockBuilder(Sdk::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ebay
            ->method('publishOffer')
            ->willReturn('12534');

        Queue::fake();

        $this->listing = factory(Listing::class)->create([
            'ebay_offer_id' => '1234',
        ]);
    }

    public function testNormalSuccess()
    {
        $job = new PublishEbayOffer($this->listing);
        $job->handle($this->ebay);

        $this->listing->refresh();

        $this->assertEquals('12534', $this->listing->ebay_listing_id);
    }
}

