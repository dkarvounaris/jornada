<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

abstract class EnvironmentSeeder extends Seeder
{
    protected array $seeders = [
        // ClassSeeder::class
    ];

    public function run(): void
    {
        $this->runSeeders();
    }

    protected function runSeeders(): void
    {
        array_map(fn($s) => $this->call($s), $this->seeders);
    }
}
