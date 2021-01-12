<?php

namespace App\Jobs;

use App\Ebay\Sdk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class PublishEbayOffer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $offerId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $offerId)
    {
        $this->offerId = $offerId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Sdk $ebay)
    {
        try {
            $ebay->publishOffer($this->offerId);
        } catch (\Exception $e) {
            $this->listing->to_ebay_error_at = Carbon::now()->toDateTimeString();
            $this->listing->save();
            throw $e;
        }
    }
}
