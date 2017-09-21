<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('backup:clean')->dailyAt('23:00');
        $schedule->command('backup:run')->dailyAt('00:00');
        
        $schedule->command('backup:clean')->weekly()->fridays()->at('01:00');
        $schedule->command('backup:run')->weekly()->fridays()->at('02:00');
        
        $schedule->command('backup:clean')->monthlyOn(28, '03:00');
        $schedule->command('backup:run')->monthlyOn(28, '04:00'); 
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands() {
        require base_path('routes/console.php');
    }

}
