<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\User;
use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Illuminate\Support\Carbon;
use Tests\WaxAppTestCase;
use Wax\Shop\Models\Product;
use Wax\Shop\Services\ShopService;

class CouponValidatorTest extends WaxAppTestCase
{
    /* @var ShopService $shop */
    protected $shopService;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);

        $this->listing = factory(Listing::class)->create(['price' => 26]);
        $this->listing->items()->saveMany(factory(ListingItem::class, 3)->make());

        $this->user = factory(User::class)->create();
    }

    public function testMinimumOrder()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'dollars' => 20,
                'minimum_order' => 50,
                'one_time' => true,
            ]);

        // minimum order has not been met
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_minimum')
        );
        $this->assertFalse($this->shopService->applyCoupon($coupon->code));

        // good to go
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order->refresh();
        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertTrue($couponValidator->passes());
        $this->assertTrue(
            $couponValidator->messages()->isEmpty()
        );

        $this->assertTrue($this->shopService->applyCoupon($coupon->code));
    }

    public function testExpiredCoupon()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'expired_at' => Carbon::yesterday(),
                'one_time' => true,
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_expired')
        );

        $this->assertFalse($this->shopService->applyCoupon($coupon->code));

        $order = $this->shopService->getActiveOrder();

        $this->assertEquals($order->item_gross_subtotal, $order->item_subtotal);
        $this->assertEquals($order->shipping_gross_subtotal, $order->shipping_subtotal);
        $this->assertEquals($order->gross_total, $order->total);
    }

    public function testOneTimeUseAvailable()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => true,
                'uses' => 0,
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertTrue($couponValidator->passes());
        $this->assertTrue($this->shopService->applyCoupon($coupon->code));
    }

    public function testOneTimeUseExhausted()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => true,
                'uses' => 1,
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_too_many_uses')
        );
        $this->assertFalse($this->shopService->applyCoupon($coupon->code));
    }

    public function testRequiresLogin()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => false,
                'uses' => 5,
                'permitted_uses' => 4,
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_not_logged_in')
        );
        $this->assertFalse($this->shopService->applyCoupon($coupon->code));
    }

    public function testMultipleUsesLeft()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => false,
                'uses' => 1,
                'permitted_uses' => 2,
            ]);

        $this->be($this->user);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertTrue($couponValidator->passes());
        $this->assertTrue($this->shopService->applyCoupon($coupon->code));
    }

    public function testUnlimitedUses()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => false,
                'uses' => PHP_INT_MAX,
                'permitted_uses' => null,
            ]);

        $this->be($this->user);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertTrue($couponValidator->passes());
        $this->assertTrue($this->shopService->applyCoupon($coupon->code));
    }

    public function testMultipleUsesExhausted()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => false,
                'uses' => 5,
                'permitted_uses' => 5,
            ]);

        $this->be($this->user);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_too_many_uses')
        );
        $this->assertFalse($this->shopService->applyCoupon($coupon->code));
    }

    public function testUserHasAlreadyUsedCoupon()
    {
        $coupon = factory(Coupon::class)
            ->create([
                'percent' => 10,
                'one_time' => false,
                'uses' => 5,
                'permitted_uses' => 6,
            ]);

        $oldOrder = new Order();
        $oldOrder->user_id = $this->user->id;
        $oldOrder->placed_at = Carbon::now()->toDateTimeString();
        $oldOrder->save();

        $oldOrder->coupon()->save(new Order\Coupon(['code' => $coupon->code]));

        $this->be($this->user);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);
        $order = $this->shopService->getActiveOrder();

        $couponValidator = new OrderCouponValidator($order, $coupon);
        $this->assertFalse($couponValidator->passes());
        $this->assertEquals(
            $couponValidator->messages()->first('general'),
            __('shop::coupon.validation_user_used_before')
        );
        $this->assertFalse($this->shopService->applyCoupon($coupon->code));
    }
}
