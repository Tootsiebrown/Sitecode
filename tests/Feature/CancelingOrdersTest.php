<?php

namespace Tests\Feature;

use App\Ebay\Sdk;
use App\Events\InventoryChangedEvent;
use App\Models\EbayOrder;
use App\Models\Listing;
use App\User;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Models\Order\ShippingRate;
use App\Wax\Shop\Support\CheckoutInventoryManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\Shop\Traits\GeneratesCreditCardPayments;
use Tests\Shop\Traits\SetsShippingAddress;
use Tests\WaxAppTestCase;
use Wax\Shop\Payment\Drivers\CreditCardPaymentDummyDriver;
use Wax\Shop\Payment\PaymentTypeFactory;
use Wax\Shop\Repositories\OrderRepository;
use Wax\Shop\Services\ShopService;

class CancelingOrdersTest extends WaxAppTestCase
{
    use SetsShippingAddress;
    use GeneratesCreditCardPayments;

    private $ebayOrder;
    private $listing1;
    private $listing2;
    private $shopService;
    /** @var Order */
    private Order $order;

    /** @var Sdk|\PHPUnit\Framework\MockObject\MockObject */

    public function setUp(): void
    {
        parent::setUp();

        Queue::fake();
        Event::fake();
        Mail::fake();

        $this->shopService = new ShopService(new OrderRepository());

        $this->listing1 = factory(Listing::class)->create(['id' => 35]);
        factory(Listing\Item::class, 5)->create(['listing_id' => 35]);

        $this->listing2 = factory(Listing::class)->create(['id' => 57]);
        factory(Listing\Item::class, 5)->create(['listing_id' => 57]);

        $this->listing3 = factory(Listing::class)->create(['id' => 49]);
        factory(Listing\Item::class, 5)->create(['listing_id' => 49]);

        $this->order = $this->buildAndPlaceOrder();

        $this->ebayOrder = factory(EbayOrder::class)->create();
        $this->listing1->availableItems()
            ->take(1)
            ->update(['ebay_order_id' => $this->ebayOrder->id]);
        $this->listing2->availableItems()
            ->take(1)
            ->update(['ebay_order_id' => $this->ebayOrder->id]);

        $this->user = factory(User::class)->create();
        Auth::shouldReceive('user')
            ->once()
            ->andReturn($this->user);
    }

    public function testCancelEbayOrderUpdatesProperItems()
    {
        $this->assertProperBeginningState();

        $this->ebayOrder->cancel();

        $this->assertEquals(3, $this->listing1->availableItems()->count());
        $this->assertEquals(3, $this->listing2->availableItems()->count());

        $this->assertProperEventsFired();
    }

    public function testCancelWebsiteOrderUpdatesProperItems()
    {
        $this->assertProperBeginningState();

        $this->order->cancel();

        $this->assertEquals(4, $this->listing1->availableItems()->count());
        $this->assertEquals(4, $this->listing2->availableItems()->count());

        $this->assertProperEventsFired();
    }

    private function assertProperBeginningState()
    {
        $this->assertEquals(2, $this->listing1->availableItems()->count());
        $this->assertEquals(2, $this->listing2->availableItems()->count());
    }

    protected function buildAndPlaceOrder() : Order
    {
        config(['wax.shop.payment.credit_card_payment_driver' => CreditCardPaymentDummyDriver::class]);

        if (!$this->shopService) {
            $this->shopService = app()->make(ShopService::class);
        }

        // set up the order
        $this->shopService->addOrderItem(1, 2, [], [1 => $this->listing1->id]);
        $this->shopService->addOrderItem(1, 2, [], [1 => $this->listing2->id]);
        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());
        $this->shopService->calculateTax();

        $order = $this->shopService->getActiveOrder();

        $data = $this->generateCreditCardPaymentData();
        $card = PaymentTypeFactory::create('credit_card', $data);
        $this->shopService->applyPayment($card);

        $inventoryManager = new CheckoutInventoryManager();
        $inventoryManager->reserveItems($order);
        $inventoryManager->markItemsSold($order);

        return $order->fresh();
    }

    private function assertProperEventsFired(): void
    {
        Event::assertDispatched(InventoryChangedEvent::class, function ($event) {
            return $event->listing->id === $this->listing1->id;
        });

        Event::assertDispatched(InventoryChangedEvent::class, function ($event) {
            return $event->listing->id === $this->listing2->id;
        });

        Event::assertNotDispatched(InventoryChangedEvent::class, function ($event) {
            return $event->listing->id === $this->listing3->id;
        });
    }
}
