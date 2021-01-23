<?php

namespace App\Jobs;

use App\Models\EbayOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class EbayMarkOrderShipped implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private string $ebayOrderEbayId;

    /**
     * Create a new job instance.
     *
     * @param string $ebayOrderEbayId
     */
    public function __construct(string $ebayOrderEbayId)
    {
        $this->ebayOrderEbayId = $ebayOrderEbayId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        EbayOrder::where('ebay_id', $this->ebayOrderEbayId)
            ->update(['shipped_at' => Carbon::now()->toDateTimeString()]);
    }
}
