<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\ProductCategory;
use App\User;
use App\Wax\Shop\Models\Coupon;
use App\Wax\Shop\Models\Order;
use App\Wax\Shop\Services\ShippingService;
use App\Wax\Shop\Validators\OrderCouponValidator;
use Illuminate\Support\Carbon;
use Tests\WaxAppTestCase;
use Wax\Shop\Models\Product;
use Wax\Shop\Services\ShopService;

class CouponDiscountDistributionTest extends WaxAppTestCase
{
    /* @var ShopService $shop */
    protected $shopService;

    /* @var Listing */
    private $discountableListing;

    /* @var Listing */
    private $nonDiscountableListing;

    /* @var Listing */
    private $discountableListing2;

    /* @var Coupon */
    private $coupon;

    /* @var Coupon */
    private $coupon2;

    /* @var Coupon */
    private $bigCoupon;

    /* @var Coupon */
    private $bigCouponWithShipping;

    /* @var ProductCategory */
    private $category;

    /* @var ProductCategory */
    private $category2;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);
        $this->category = factory(ProductCategory::class)->create();
        $this->category2 = factory(ProductCategory::class)->create();

        $this->coupon = factory(Coupon::class)
            ->create([
                'dollars' => 20,
                'one_time' => true,
                'category_id' => $this->category->id
            ]);

        $this->coupon2 = factory(Coupon::class)
            ->create([
                'dollars' => 15,
                'one_time' => true,
                'category_id' => $this->category2->id
            ]);

        $this->bigCoupon = factory(Coupon::class)
            ->create([
                'dollars' => 100,
                'one_time' => true,
                'category_id' => $this->category,
            ]);

        $this->bigCouponWithShipping = factory(Coupon::class)
            ->create([
                'dollars' => 100,
                'one_time' => true,
                'category_id' => $this->category,
                'include_shipping' => true,
            ]);

        $this->normalOlCoupon = factory(Coupon::class)
            ->create([
                'dollars' => 10,
                'one_time' => true,
                'include_shipping' => true,
            ]);

        $this->discountableListing = factory(Listing::class)->create(['price' => 30]);
        $this->discountableListing->items()->saveMany(factory(ListingItem::class, 3)->make());
        $this->discountableListing->categories()->attach($this->category->id);

        $this->discountableListing2 = factory(Listing::class)->create(['price' => 20]);
        $this->discountableListing2->items()->saveMany(factory(ListingItem::class, 3)->make());
        $this->discountableListing2->categories()->attach($this->category->id);

        $this->nonDiscountableListing = factory(Listing::class)->create(['price' => 25]);
        $this->nonDiscountableListing->items()->saveMany(factory(ListingItem::class, 3)->make());

        // so the test stays the same even if we go back to shipstation shipping rates
        config(['shipping.custom_shipping' => true]);
        config(['services.ship_station.api_key' => 'asdf']);
        config(['services.ship_station.api_secret' => 'asdf']);
        config(['services.ship_station.api_url' => 'asdf']);
    }

    public function testDiscountDistributionWithNoConditions()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->normalOlCoupon->code));

        $order = $this->shopService->getActiveOrder();

        // order total is $35
        $this->assertEquals("20.00", $order->total);

        $order->items->each(function ($item) {
            if ($item->listing_id == $this->discountableListing->id) {
                $this->assertEquals(10, $item->discount_amount);
            } else {
                throw new \Exception('whoops');
            }
        });
    }

    public function testDiscountableTotalOnlyInCategory()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->nonDiscountableListing->id]);

        $this->assertEquals(30, $this->shopService->getActiveOrder()->getDiscountableTotalFor($this->coupon));
    }

    public function testDiscountAppliedOnlyToItem()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->nonDiscountableListing->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->coupon->code));

        $order = $this->shopService->getActiveOrder();

        // order total is $35
        $this->assertEquals("35.00", $order->total);

        $order->items->each(function ($item) {
            if ($item->listing_id == $this->discountableListing->id) {
                $this->assertEquals(20, $item->discount_amount);
            } else {
                $this->assertEquals(0, $item->discount_amount);
            }
        });
    }

    public function testDiscountSpreadAcrossMultiple()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing2->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->coupon->code));

        $order = $this->shopService->getActiveOrder();

        // order total is $30
        $this->assertEquals("30.00", $order->total);

        $order->items->each(function ($item) {
            if ($item->listing_id == $this->discountableListing->id) {
                $this->assertEquals(12, $item->discount_amount);
            } else {
                $this->assertEquals(8, $item->discount_amount);
            }
        });
    }

    public function testDiscountShippingAppliedProperly()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);


        $this->assertTrue($this->shopService->applyCoupon($this->bigCouponWithShipping->code));

        $order = $this->shopService->getActiveOrder();
        app()->make(ShippingService::class)->refreshRatesFor($order);
        $order->refresh();

        $this->assertEquals("8.99", $order->shipping_gross_subtotal);
        $this->assertEquals("8.99", $order->shipping_discount_amount);
        $this->assertEquals("30.00", $order->item_gross_subtotal);
        $this->assertEquals("30.00", $order->item_discount_amount);
        $this->assertEquals("0.00", $order->total);
    }

    public function testDiscountShippingNotAppliedProperly()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->bigCoupon->code));

        $order = $this->shopService->getActiveOrder();
        app()->make(ShippingService::class)->refreshRatesFor($order);

        $this->assertEquals("8.99", $order->shipping_gross_subtotal);
        $this->assertEquals("0.00", $order->shipping_discount_amount);
        $this->assertEquals("30.00", $order->item_gross_subtotal);
        $this->assertEquals("30.00", $order->item_discount_amount);
        $this->assertEquals("8.99", $order->total);
    }

    public function testDiscountRoundingLeftoverAccountedFor()
    {
        $listing = factory(Listing::class)->create(['price' => 30]);
        $listing->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing->categories()->attach($this->category->id);

        $coupon = factory(Coupon::class)
            ->create([
                'dollars' => 1.25,
                'one_time' => true,
                'category_id' => $this->category
            ]);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->discountableListing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->nonDiscountableListing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $listing->id]);

        $this->assertTrue($this->shopService->applyCoupon($coupon->code));

        $this->shopService->getActiveOrder()->items->each(function ($item) use ($listing) {
            if ($item->listing_id == $this->discountableListing->id) {
                $this->assertEquals(.63, $item->discount_amount);
            } elseif ($item->listing_id == $listing->id) {
                $this->assertEquals(.62, $item->discount_amount);
            } else {
                $this->assertEquals(0, $item->discount_amount);
            }
        });
    }

    public function testMultipleCoupons()
    {
        $listing = factory(Listing::class)->create(['price' => 30]);
        $listing->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing->categories()->attach($this->category->id);

        $listing2 = factory(Listing::class)->create(['price' => 30]);
        $listing2->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing2->categories()->attach($this->category2->id);

        $this->shopService->addOrderItem(1, 1, [], [1 => $listing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $listing2->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->coupon->code));
        $this->assertTrue($this->shopService->applyCoupon($this->coupon2->code));

        $this->shopService->getActiveOrder()->items->each(function ($item) use ($listing, $listing2) {
            if ($item->listing_id == $listing->id) {
                $this->assertEquals(20, $item->discount_amount);
            } elseif ($item->listing_id == $listing2->id) {
                $this->assertEquals(15, $item->discount_amount);
            } else {
                throw new \Exception('This case should not be hit by this test.');
            }
        });

        $order = $this->shopService->getActiveOrder();
        $this->assertEquals("60.00", $order->gross_total);
        $this->assertEquals("25.00", $order->item_subtotal);
        $this->assertEquals("35.00", $order->discount_amount);
        $this->assertEquals("25.00", $order->balance_due);
    }

    public function testMultipleCouponsAndDistribution()
    {
        $listing = factory(Listing::class)->create(['price' => 30]);
        $listing->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing->categories()->attach($this->category->id);

        $listing2 = factory(Listing::class)->create(['price' => 30]);
        $listing2->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing2->categories()->attach($this->category2->id);

        $listing3 = factory(Listing::class)->create(['price' => 25]);
        $listing3->items()->saveMany(factory(ListingItem::class, 3)->make());
        $listing3->categories()->attach($this->category->id);

        $this->shopService->addOrderItem(1, 1, [], [1 => $listing->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $listing2->id]);
        $this->shopService->addOrderItem(1, 1, [], [1 => $listing3->id]);

        $this->assertTrue($this->shopService->applyCoupon($this->coupon->code));
        $this->assertTrue($this->shopService->applyCoupon($this->coupon2->code));

        $this->shopService->getActiveOrder()->items->each(function ($item) use ($listing, $listing2, $listing3) {
            if ($item->listing_id == $listing->id) {
                $this->assertEquals(10.91, $item->discount_amount); //54%
            } elseif ($item->listing_id == $listing2->id) {
                $this->assertEquals(15, $item->discount_amount);
            } elseif ($item->listing_id == $listing3->id) {
                $this->assertEquals(9.09, $item->discount_amount);
            } else {
                throw new \Exception('This case should not be hit by this test.');
            }
        });

        $order = $this->shopService->getActiveOrder();
        $this->assertEquals("85.00", $order->gross_total);
        $this->assertEquals("50.00", $order->item_subtotal);
        $this->assertEquals("35.00", $order->discount_amount);
        $this->assertEquals("50.00", $order->balance_due);
    }
}
