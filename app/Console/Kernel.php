<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // Monitor scheduled tasks
    $schedule->command('monitor:schedule')->everyMinute();
    
    // Uptime monitoring
    $schedule->command('monitor:check-uptime')->everyMinute();
    $schedule->command('monitor:check-certificates')->daily();
    
    // Log cleanup
    $schedule->command('log:clear --keep-last')->daily();
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
    
    // Schedule Monitor
    \Spatie\ScheduleMonitor\Models\MonitoredScheduledTask::query()
        ->where('name', 'like', '%monitor:schedule%')
        ->update(['should_run_in_maintenance_mode' => true]);
    }
}
