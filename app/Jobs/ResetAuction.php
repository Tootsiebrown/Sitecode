<?php

namespace App\Jobs;

use App\Models\EndedAuction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResetAuction implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /** @var EndedAuction */
    public EndedAuction $endedAuction;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EndedAuction $endedAuction)
    {
        $this->endedAuction = $endedAuction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // just in case we hit a weird race condition, let's double check
        if ($this->endedAuction->purchased_at) {
            return;
        }


    }
}
