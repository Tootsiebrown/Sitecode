<?php

namespace Tests\Feature;

use App\Ebay\Sdk;
use App\Jobs\Ebay\SyncPendingTransaction;
use App\Jobs\Ebay\SyncOrder;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;

class EbayWebhookTest extends WaxAppTestCase
{
    /** @var Sdk|\PHPUnit\Framework\MockObject\MockObject */

    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();
    }

    public function testEbayAuctionCheckoutComplete()
    {
        $response = $this->call(
            'POST',
            route('webhooks.ebayNotification', false),
            [],
            [],
            [],
            [],
            file_get_contents(__DIR__ . '/stubs/auctionCheckoutComplete.xml'),
        );

        $response
            ->assertStatus(200);

        Queue::assertPushed(SyncOrder::class, function ($job) {
            return $job->ebayOrderId == '08-06401-35793';
        });
    }

    public function testEbayPendingTransaction()
    {
        $response = $this->call(
            'POST',
            route('webhooks.ebayNotification', false),
            [],
            [],
            [],
            [],
            file_get_contents(__DIR__ . '/stubs/fixedPriceTransaction.xml'),
        );

        $response
            ->assertStatus(200);

        Queue::assertPushed(SyncPendingTransaction::class, function ($job) {
            return $job->sku === 'website-6339'
                && $job->quantity === 1
                && $job->transactionId === '1882947786019';
        });
    }
}
