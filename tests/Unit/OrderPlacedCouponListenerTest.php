<?php

namespace Tests\Unit;

use App\Listeners\OrderPlacedCouponListener;
use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order\ShippingRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\Shop\Traits\GeneratesCreditCardPayments;
use Tests\Shop\Traits\SetsShippingAddress;
use Tests\PrepsShopEmailMocks;
use Tests\WaxAppTestCase;
use Wax\Shop\Events\OrderPlacedEvent;
use Wax\Shop\Payment\Drivers\CreditCardPaymentDummyDriver;
use Wax\Shop\Payment\PaymentTypeFactory;
use Wax\Shop\Services\ShopService;

class OrderPlacedCouponListenerTest extends WaxAppTestCase
{
    use GeneratesCreditCardPayments;
    use SetsShippingAddress;
    use PrepsShopEmailMocks;

    /* @var ShopService $shop */
    protected $shopService;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);
        config(['wax.shop.payment.credit_card_payment_driver' => CreditCardPaymentDummyDriver::class]);

        $this->listing = factory(Listing::class)->create(['price' => 26]);
        $this->listing->items()->saveMany(factory(ListingItem::class, 3)->make());

        Mail::fake();
        Queue::fake();

        $this->prepShopEmailMocks();
    }

    public function testListenerCalled()
    {
        $listener = Mockery::spy(OrderPlacedCouponListener::class);
        app()->instance(OrderPlacedCouponListener::class, $listener);

        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'expired_at' => Carbon::tomorrow(),
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $this->shopService->applyCoupon($coupon->code);

        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());

        $this->shopService->calculateTax();

        // make the payment
        $data = $this->generateCreditCardPaymentData();

        $card = PaymentTypeFactory::create('credit_card', $data);

        $payment = $this->shopService->applyPayment($card);

        $listener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) use ($coupon) {
                return $event->order()->coupon->code == $coupon->code;
            }))
            ->once();
    }

    public function testListenerIncrementsUsageCount()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'expired_at' => Carbon::tomorrow(),
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $this->shopService->applyCoupon($coupon->code);

        $listener = app()->make(OrderPlacedCouponListener::class);
        $event = new OrderPlacedEvent($this->shopService->getActiveOrder());

        $listener->handle($event);
        $coupon->refresh();

        $this->assertEquals(1, $coupon->uses);

        $listener->handle($event);
        $coupon->refresh();

        $this->assertEquals(2, $coupon->uses);
    }

}
