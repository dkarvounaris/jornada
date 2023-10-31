<?php

namespace App\Core\Console;

use App\Core\Console\Jornada;
use Illuminate\Console\Application;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class JornadaKernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function commands(): void
    {
        // TODO: Define list of commands in config and/or load from another custom folder in application-space
        $this->commands = [
            \App\Core\Console\Commands\Jornada\JornadaTest::class
        ];
        require base_path('routes/jornada.php');
    }

    /**
     * Get the Artisan application instance.
     * @return \App\Core\Console\Jornada
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function getArtisan(): Application
    {
        if (\is_null($this->artisan)) {
            $this->artisan = (new Jornada($this->app, $this->events, $this->app->version()))
                ->resolveCommands($this->commands)
                ->setContainerCommandLoader();
        }
        return $this->artisan;
    }
}
