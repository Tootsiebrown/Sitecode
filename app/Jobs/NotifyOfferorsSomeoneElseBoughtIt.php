<?php

namespace App\Jobs;

use App\Mail\SomeoneElseboughtIt;
use App\Wax\Shop\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyOfferorsSomeoneElseBoughtIt implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * @var Order
     */
    private Order $order;

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
    public function handle()
    {
        $this->order->items
            ->each(function ($item) {
                if ($item->listing->availableItems()->count() === 0) {
                    $sql = $item
                        ->listing
                        ->offers()
                        ->where(function ($query) {
                            $query
                                ->where(function ($query) {
                                    $query->status('accepted');
                                })
                                ->orWhere(function ($query) {
                                    $query->status('countered');
                                })
                                ->orWhere(function ($query) {
                                    $query->status('counter_accepted');
                                })
                                ->orWhere(function ($query) {
                                    $query->status('pending');
                                });
                        })
                        ->get()
                        ->each(function ($offer) {
                            if ($offer->user_id === $this->order->user_id) {
                                return;
                            }

                            $offer->reject();
                            Mail::queue(new SomeoneElseBoughtIt($offer));
                        });
                }
            });
    }
}
