<?php

namespace Tests\Unit;

use App\Ebay\Sdk;
use App\Jobs\MarkEbayItemsSold;
use App\Jobs\Ebay\SyncOrder;
use App\Models\EbayOrder;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\WaxAppTestCase;

class EbaySyncOrderTest extends WaxAppTestCase
{
    private string $mockOrderId = '369-543';
    /** @var Sdk|MockObject */
    private $ebay;

    public function setUp(): void
    {
        parent::setUp();

        $this->ebay = $this->getMockBuilder(Sdk::class)
            ->disableOriginalConstructor()
            ->getMock();

        Queue::fake();
    }

    public function testSaveOrder()
    {
        $this->assertEquals(0, EbayOrder::all()->count());

        $this->ebay
            ->method('getOrder')
            ->willReturn($this->getMockOrder());

        $job = new SyncOrder($this->mockOrderId);
        $job->handle($this->ebay);

        $ebayOrders = EbayOrder::all();

        $this->assertEquals(1, $ebayOrders->count());
        $localEbayOrder = $ebayOrders->first();
        $this->assertEquals($this->mockOrderId, $localEbayOrder->ebay_id);

        Queue::assertPushed(MarkEbayItemsSold::class, function ($job) use ($localEbayOrder) {
            return $localEbayOrder->id == $job->ebayOrderId
                && $job->quantity == 2
                && $job->listingId = 357;
        });
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

