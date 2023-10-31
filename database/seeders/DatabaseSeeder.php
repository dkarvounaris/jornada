<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Call the application's environment-specific database seeder.
     *
     * Tip: For separating suites by feature epics, ie. for faster testing, other conditions
     * and separate testing seed suites can be created and may be triggered individually by env() or other conditions
     */
    public function run(): void
    {
        $this->runSystemSeeds();

        $this->call(
            match (app()->environment()) {
                'local' => LocalDatabaseSeeder::class,
                'production' => ProductionDatabaseSeeder::class,
                'staging' => StagingDatabaseSeeder::class,
                'testing' => TestingDatabaseSeeder::class
            }
        );
    }

    /**
     * Call the application's system seeder (always required seeds).
     */
    protected function runSystemSeeds(): void
    {
        $this->call(SystemDatabaseSeeder::class);
    }
}
