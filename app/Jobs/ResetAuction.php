<?php

namespace App\Jobs;

use App\Models\EndedAuction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function () {
            $this->endedAuction->listing->expired_at = Carbon::now()
                ->addDays(2)
                ->setHour(20)
                ->setMinute(0)
                ->setSecond(0);
            $this->endedAuction->listing->save();
            $this->endedAuction->listing->bids()->delete();

            $this->endedAuction->delete();
        }, 3);

    }
}
