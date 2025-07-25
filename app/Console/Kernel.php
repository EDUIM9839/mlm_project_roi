<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
     
         protected $commands = [

         Commands\RoiCron::class,
         Commands\RewardCronCommand::class,
         Commands\RoyalityCommand::class,
         Commands\SalaryCommand::class,
         Commands\CheckPayment::class,

         ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
         $schedule->command('roi:execute')->cron('* * * * *')->appendOutputTo(storage_path('logs/cron.log'));
         $schedule->command('reward:execute')->cron('* * * * *')->appendOutputTo(storage_path('logs/cron.log'));
         $schedule->command('royality:execute')->cron('* * * * *')->appendOutputTo(storage_path('logs/cron.log'));
         $schedule->command('salary:execute')->cron('* * * * *')->appendOutputTo(storage_path('logs/cron.log'));
         $schedule->command('check_payment:execute')->cron('* * * * *')->appendOutputTo(storage_path('logs/cron.log'));
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
