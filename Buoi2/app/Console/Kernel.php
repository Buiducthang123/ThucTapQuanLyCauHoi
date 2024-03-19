<?php

namespace App\Console;
use App\Console\Commands\sendMailwork;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        sendMailwork::class
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('send-mailwork')->dailyAt("09:28");
            //  ->daily()
            //  ->at('09:25');
        $schedule->command('app:send-mailwork')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
