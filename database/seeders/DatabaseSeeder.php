<?php

namespace Database\Seeders;

use Database\Seeders\ClassNameSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\UserTypeSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            ClassNameSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
