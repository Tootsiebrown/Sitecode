<?php

namespace Tests\Unit;

use App\Jobs\Ebay\SyncPendingTransaction;
use App\Models\EbayOrder;
use App\Models\Listing;
use Tests\WaxAppTestCase;

class EbaySyncPendingTransactionTest extends WaxAppTestCase
{
    private $mockTransactionId = '777777777';
    private $mockSku = 'testing-45678';
    private $mockListingId = 45678;
    private $mockQuantity = 3;

    public function setUp(): void
    {
        parent::setUp();

        $this->listing = factory(Listing::class)->create(['id' => $this->mockListingId]);
        factory(Listing\Item::class, 3)->create(['listing_id' => $this->mockListingId]);
    }

    public function testSaveOrder()
    {
        $this->assertEquals(0, EbayOrder::all()->count());

        $job = new SyncPendingTransaction(
            $this->mockTransactionId,
            $this->mockSku,
            $this->mockQuantity
        );

        $job->handle();

        $ebayOrders = EbayOrder::all();

        $this->assertEquals(1, $ebayOrders->count());
        $localEbayOrder = $ebayOrders->first();
        $this->assertNull($localEbayOrder->ebay_id);
        $this->assertEquals($this->mockTransactionId, $localEbayOrder->transaction_id);

        $this->assertEquals($this->mockQuantity, $localEbayOrder->items()->count());
    }

    public function testOrderHasNoWebsiteItems()
    {
        $this->ebay
            ->method('getOrder')
            ->willReturn($this->getMockOrderWithNoRelevantItems());

        $job = new SyncOrder($this->mockOrderId);
        $job->handle($this->ebay);

        $this->assertEquals(0, EbayOrder::all()->count());
    }

    private function getMockOrder()
    {
        return json_decode(json_encode([
            'lineItems' => [
                [
                    'quantity' => 2,
                    'sku' => 'testing-357'
                ]
            ]
        ]));
    }

    private function getMockOrderWithNoRelevantItems()
    {
        return json_decode(json_encode([
            'lineItems' => [
                [
                    'quantity' => 2,
                    'sku' => '357'
                ]
            ]
        ]));
    }
}

