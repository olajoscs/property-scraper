<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    private const LOG_PATH = 'storage/logs/';


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
    protected function schedule(Schedule $schedule)
    {
        $time = (new \DateTime())->format('Y-m-d-H-i-s');

        $schedule
            ->command('property:search')
            ->everyFifteenMinutes()
            ->between('5:00', '22:00')
            ->sendOutputTo(self::LOG_PATH . 'property-search-' . $time);

        $schedule
            ->command('log:clean')
            ->dailyAt('00:05');
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
