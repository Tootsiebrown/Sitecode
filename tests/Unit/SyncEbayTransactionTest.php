<?php

namespace Tests\Unit;

use App\Bid;
use App\Ebay\Sdk;
use App\Jobs\MarkEbayItemsSold;
use App\Jobs\NotifyWinner;
use App\Jobs\SyncEbayTransaction;
use App\Mail\NotifyNoWinner as NotifyNoWinnerEmail;
use App\Mail\NotifyWinner as NotifyWinnerEmail;
use App\Models\EbayOrder;
use App\Models\Listing;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\WaxAppTestCase;
use Wax\Shop\Services\ShopService;

class SyncEbayTransactionTest extends WaxAppTestCase
{
    private $mockOrderId = 369;

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
            ->method('getTransaction')
            ->willReturn($this->getMockTransaction());

        $this->ebay
            ->method('getOrder')
            ->willReturn($this->getMockOrder());


        $job = new SyncEbayTransaction(4950);
        $job->handle($this->ebay);

        $ebayOrders = EbayOrder::all();

        $this->assertEquals(1, $ebayOrders->count());
        $ebayOrder = $ebayOrders->first();
        $this->assertEquals($this->mockOrderId, (int)$ebayOrder->ebay_id);

        Queue::assertPushed(MarkEbayItemsSold::class, function ($job) use ($ebayOrder) {
            return $ebayOrder->id == $job->ebayOrderId
                && $job->quantity == 2
                && $job->listingId = 357;
        });
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

    private function getMockTransaction()
    {
        return json_decode(json_encode([
            'orderId' => $this->mockOrderId
        ]));
    }
}

