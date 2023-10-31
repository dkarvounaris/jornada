<?php

namespace App\Core\Console;

use Illuminate\Console\Application as ConsoleApplication;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Jornada extends ConsoleApplication
{
    /**
     * Create a new Jornada console application.
     */
    public function __construct(Container $laravel, Dispatcher $events, $version)
    {
        parent::__construct($laravel, $events, $version);
        $this->setName('Jornada App');
        $this->setVersion('0.1');

        // AboutCommand::add('My Package', fn () => ['Version' => '1.0.0']);
    }

    /**
     * Limits the available commands to those in the Jornada namespace
     */
    public function resolve($command): SymfonyCommand|null
    {
        // quick-check for namespace (avoids intentionally reflection to not load classes not used)
        if (!Str::contains($command, 'Jornada')) {
            return null;
        }

        return parent::resolve($command);
    }
}
