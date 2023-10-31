<?php

namespace App\Core\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function schedule(Schedule $schedule): void
    {
        // TODO: Add "auto-discovery" Scheduler
    }

    /**
     * Register the commands for the application.
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands/Artisan');

        require base_path('routes/console.php');
    }
}
