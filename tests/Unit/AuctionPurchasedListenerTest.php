<?php

namespace Tests\Unit;

use App\Bid;
use App\Jobs\SetAuctionPurchased;
use App\Listeners\AuctionPurchasedListener;
use App\Models\Listing;
use App\Models\Listing\Item as ListingItem;
use App\User;
use App\Wax\Shop\Models\Order\ShippingRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\Shop\Traits\GeneratesCreditCardPayments;
use Tests\Shop\Traits\SetsShippingAddress;
use Tests\PrepsShopEmailMocks;
use Tests\WaxAppTestCase;
use Wax\Shop\Payment\Drivers\CreditCardPaymentDummyDriver;
use Wax\Shop\Payment\PaymentTypeFactory;
use Wax\Shop\Services\ShopService;

class AuctionPurchasedListenerTest extends WaxAppTestCase
{
    use GeneratesCreditCardPayments;
    use SetsShippingAddress;
    use PrepsShopEmailMocks;

    /* @var ShopService $shop */
    protected $shopService;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $user;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private $listing;

    public function setUp(): void
    {
        parent::setUp();

        $this->shopService = app()->make(ShopService::class);
        config(['wax.shop.payment.credit_card_payment_driver' => CreditCardPaymentDummyDriver::class]);

        $this->listing = factory(Listing::class)->create(['price' => 26]);
        $this->listing->items()->save(factory(ListingItem::class)->make());

        $this->user = factory(User::class)->create();

        Mail::fake();
        Queue::fake();

        $this->prepShopEmailMocks();
    }

    public function testListenerCalled()
    {
        $listener = Mockery::spy(AuctionPurchasedListener::class);
        app()->instance(AuctionPurchasedListener::class, $listener);

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);


        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());

        $this->shopService->calculateTax();

        // make the payment
        $data = $this->generateCreditCardPaymentData();
        $card = PaymentTypeFactory::create('credit_card', $data);
        $this->shopService->applyPayment($card);

        $listener->shouldHaveReceived('handle')
            ->with(Mockery::on(function ($event) {
                return $event->order()->items->first()->listing_id === $this->listing->id;
            }))
            ->once();
    }

    public function testListenerQueuesUpdateForAuction()
    {
        $this->listing->type = 'auction';
        $this->listing->expired_at = Carbon::now()->subMinute()->toDateTimeString();
        $this->listing->save();
        $this->listing->bids()->save(new Bid(['bid_amount' => 30, 'user_id' => $this->user->id]));

        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);

        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());
        $this->shopService->calculateTax();

        // make the payment
        $data = $this->generateCreditCardPaymentData();
        $card = PaymentTypeFactory::create('credit_card', $data);
        $this->shopService->applyPayment($card);

        Queue::assertPushed(SetAuctionPurchased::class, function($job) {
            return $job->listing->id === $this->listing->id;
        });
    }

    public function testListnerDoesNotQueueUpdateForSetPrice()
    {
        $this->shopService->addOrderItem(1, 1, [], [1 => $this->listing->id]);

        $this->setShippingAddress();
        $this->shopService->setShippingService(factory(ShippingRate::class)->create());
        $this->shopService->calculateTax();

        // make the payment
        $data = $this->generateCreditCardPaymentData();
        $card = PaymentTypeFactory::create('credit_card', $data);
        $this->shopService->applyPayment($card);

        Queue::assertNotPushed(SetAuctionPurchased::class);
    }
}
