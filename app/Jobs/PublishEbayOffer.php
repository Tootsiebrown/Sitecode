<?php

namespace App\Jobs;

use App\Ebay\Sdk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $ebay->publishOffer($this->offerId);
    }
}
