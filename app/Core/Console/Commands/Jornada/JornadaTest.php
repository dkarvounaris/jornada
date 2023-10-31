<?php

namespace App\Core\Console\Commands\Jornada;

use Illuminate\Console\Command;

class JornadaTest extends Command
{
    /**
     * Indicates whether the command should be shown in the Jornada command list.
     *
     * @var bool
     */
    protected $hidden = true;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jornada:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs a command for testing';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'TEST. SUCCESS.';
    }
}
