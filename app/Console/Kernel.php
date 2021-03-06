<?php

namespace App\Console;

use App\CronEntry;
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
        'App\Console\Commands\GroupsCreate',
        'App\Console\Commands\GroupsDelete',
        'App\Console\Commands\BookingsDelete'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('group:create')
        //         ->everyMinute()
        //         ->when(function () {
        //             return CronEntry::shouldIRun('group:create', 10080); //returns true every seven days
        //         });

//the heroku scheduler runs daily at 20:30
        $schedule->command('groups:create')->fridays();
        $schedule->command('groups:delete')->monthlyOn('1');
      //  $schedule->command('bookings:delete')->monthlyOn('1');
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
