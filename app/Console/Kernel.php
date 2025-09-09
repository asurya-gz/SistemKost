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
        Commands\ExpireBookingsCommand::class,
        Commands\SendBillingNotificationsCommand::class,
        Commands\ExpireRentalBookingsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Expire bookings every 5 minutes to ensure real-time behavior
        $schedule->command('bookings:expire')
                 ->everyFiveMinutes()
                 ->withoutOverlapping()
                 ->runInBackground();

        // Send billing notifications daily at 09:00 AM
        $schedule->command('booking:send-billing-notifications')
                 ->dailyAt('09:00')
                 ->withoutOverlapping();

        // Expire rentals daily at 00:05 AM (after potential extensions)
        $schedule->command('booking:expire-rentals')
                 ->dailyAt('00:05')
                 ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}