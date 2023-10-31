<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // TODO: Load migrations only for console execution or through middleware for console, as migrations and their provider are not required otherwise
        $this->loadMigrationsFrom([
            database_path('migrations/install/'),
            ...glob(database_path('migrations/versions/') . '*', GLOB_ONLYDIR)
        ]);
    }
}
