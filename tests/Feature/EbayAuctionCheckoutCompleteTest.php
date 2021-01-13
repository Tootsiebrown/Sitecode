<?php

namespace Tests\Feature;

use App\Ebay\Sdk;
use App\Jobs\SyncEbayOrder;
use App\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class EbayAuctionCheckoutCompleteTest extends WaxAppTestCase
{
    /** @var Sdk|\PHPUnit\Framework\MockObject\MockObject */
    private $mockSdk;

    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    public function testEbayAuctionCheckoutComplete()
    {
        $response = $this->call(
            'POST',
            route('webhooks.ebayCheckoutComplete', false),
            [],
            [],
            [],
            [],
            file_get_contents(__DIR__ . '/stubs/auctionCheckoutComplete.xml'),
        );

        $response
            ->assertStatus(200);

        Queue::assertPushed(SyncEbayOrder::class, function ($job) {
            return $job->ebayOrderId == '08-06401-35793';
        });
    }
}
