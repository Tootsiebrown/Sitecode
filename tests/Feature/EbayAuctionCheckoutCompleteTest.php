<?php

namespace Tests\Feature;

use App\Ebay\Sdk;
use App\Jobs\SyncEbayTransaction;
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
            view('test-stubs.auctionCheckoutComplete')->render(),
        );

        $response
            ->assertStatus(200);

        Queue::assertPushed(SyncEbayTransaction::class, function ($job) {
            return $job->transactionId == 4950;
        });
    }
}
