<?php

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    \App\Core\Http\Kernel::class
);

if ($app->runningInConsole()) {
    $app->singleton(
        Illuminate\Contracts\Console\Kernel::class,
        \App\Core\Console\Kernel::class
    );
}

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    \App\Core\Exceptions\Handler::class
);

return $app;
