<?php

namespace App\Console;

use App\Console\Commands\ProcessAuctionsEndingInOneHour;
use App\Console\Commands\ProcessEndedAuctions;
use App\Console\Commands\ProcessExpiredOffers;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ProcessEndedAuctions::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('backup:clean')
            ->weekly();

         $schedule->command(ProcessEndedAuctions::class)
             ->everyMinute();

        $schedule->command(ProcessAuctionsEndingInOneHour::class)
            ->everyMinute();

        $schedule->command(ProcessAuctionsNeedingPayment::class)
            ->everyFiveMinutes();

         $schedule->command(ProcessExpiredOffers::class)
             ->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
