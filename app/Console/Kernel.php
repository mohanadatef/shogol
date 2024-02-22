<?php

namespace App\Console;

use App\Console\Commands\LogCron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Basic\Console\GenerateSeeders;
use Modules\Task\Console\timeOutAd;
use Modules\Task\Console\timeOutOffer;
use Modules\Task\Console\timeOutTask;

class Kernel extends ConsoleKernel
{
    /**
     * @Target GenerateSeeders command to run seeder and save in database
     * @Target timeOutAd command to check time ad and make it un active
     * @Target timeOutTask command to check time task and make it un active
     * @Target timeOutOffer command to check time offer and make it un active
     */
    protected $commands = [
        GenerateSeeders::class,
        timeOutAd::class,
        timeOutTask::class,
        timeOutOffer::class,
        LogCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     * check setting value if it has time will run every minute but if 0 will not work
     */
    protected function schedule(Schedule $schedule)
    {
        if (getValueSetting('time_out_ad') != 0) {
            $schedule->command('command:timeOutAd')
                ->daily()
                ->withoutoverlapping(5);
        }
        if (getValueSetting('time_out_task') != 0) {
            $schedule->command('command:timeOutTask')
                ->daily()
                ->withoutoverlapping(5);
        }
        if (getValueSetting('time_out_offer') != 0) {
            $schedule->command('command:timeOutOffer')
                ->daily()
                ->withoutoverlapping(5);
        }
        $schedule->command('log:cron')->weekly();
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
