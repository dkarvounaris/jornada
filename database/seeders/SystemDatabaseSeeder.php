<?php

namespace Database\Seeders;

class SystemDatabaseSeeder extends EnvironmentSeeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->runSeeders();
        // Seed by using model:
        // \App\Models\Category::create(['id' => 1, 'name' => 'some name', 'description' => 'some description']);

        // Or even faster way (when performance is key), use the query builder:
        /*
        \DB::table('categories')->insert(
            [
                ['id' => 1, 'name' => 'some name', 'description' => 'some description'],
                ['id' => 2, 'name' => 'other name', 'description' => 'other description'],
            ]
        );
        */

        //consider using  updateOrCreate() to avoid double-seeding, especially for environments like production,
        //testing may make this slower and be unnecessary though

        // call a seed from migration:
        /*
        Artisan::call('db:seed', [
            '--class' => ThemesTableSeeder::class
        ]);
        */


        // Use this, if tables are not seeded in right order and receive error "Integrity constraint violation"
        // or when knowing what we do (ie. seeding test(s) which won't require everything seeded):
        // \Schema::disableForeignKeyConstraints();  // turn off all foreign checks
        // When done seeing, re-enable:
        // \Schema::enableForeignKeyConstraints();

        // useful package to create seeds from the database: https://github.com/gbhorwood/pollinate

        // ...

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }

}
