<?php

namespace App\Jobs;

use App\Wax\Shop\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\StripeClient;

class UpdateStripeOrderId implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StripeClient $stripe)
    {
        $this
            ->order
            ->payments
            ->each(function ($payment) use ($stripe) {
                if (strpos($payment->transaction_ref, 'ch_') === 0) {
                    $stripe->charges->update(
                        $payment->transaction_ref,
                        ['description' => 'Order ID: ' . $this->order->sequence],
                    );
                }
            });
    }
}
