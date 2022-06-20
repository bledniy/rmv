<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:run')->weekly();
        $schedule->command('clear-temporary:default')->hourlyAt('35');
        $schedule->command('clear-temporary:orders')->hourlyAt('25');
        $schedule->command('deals:close-by-date')->everyMinute();
        $schedule->command('deals:reviews-publish')->everyMinute();
        $schedule->command('orders:new-bids.notify')->hourly();
        $schedule->command('premium:notify.expiring')->everyFourHours();
        //todo return to */5 min
        $schedule->command('premium:notify.expired')->dailyAt('07:30');
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
