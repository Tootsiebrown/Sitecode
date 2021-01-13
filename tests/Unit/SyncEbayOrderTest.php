<?php

namespace Tests\Unit;

use App\Bid;
use App\Ebay\Sdk;
use App\Jobs\MarkEbayItemsSold;
use App\Jobs\NotifyWinner;
use App\Jobs\SyncEbayOrder;
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

class SyncEbayOrderTest extends WaxAppTestCase
{
    private $mockOrderId = '369-543';

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


        $job = new SyncEbayOrder($this->mockOrderId);
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
}

