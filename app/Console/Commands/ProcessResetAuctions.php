<?php

namespace App\Console\Commands;

use App\Jobs\ResetAuction;
use App\Models\EndedAuction;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ProcessResetAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:process-resets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset auctions that were not paid in time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $resetableAuctions = EndedAuction::whereNull('purchased_at')
            ->where('created_at', '<', Carbon::now()->subHours(24)->toDateTimeString())
            ->get();

        $bar = $this->output->createProgressBar(count($resetableAuctions));
        $bar->start();

        foreach ($resetableAuctions as $auction) {
            ResetAuction::dispatch($auction);
            $bar->advance();
        }

        $bar->finish();
    }
}
