<?php

namespace App\Console;

use App\Console\Commands\NotifyOrder;
use App\Console\Commands\ReminderHospitalOrderAwaitingAccepte;
use App\Console\Commands\ReminderHospitalOrderMustCompleted;
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

    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command(NotifyOrder::class)->everyMinute();
//        $schedule->command(ReminderHospitalOrderMustCompleted::class)->cron('*/20 * * * *');
//        $schedule->command(ReminderHospitalOrderAwaitingAccepte::class)->cron('*/20 * * * *');
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
