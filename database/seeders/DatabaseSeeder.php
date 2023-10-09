<?php

namespace Database\Seeders;

use Database\Seeders\ClassNameSeeder;
use Database\Seeders\ClsSeeder;
use Database\Seeders\ExamInfoSeeder;
use Database\Seeders\ResultSeeder;
use Database\Seeders\StudentInfoSeeder;
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
            ClsSeeder::class,
            SubjectSeeder::class,
            StudentInfoSeeder::class,
            ExamInfoSeeder::class,
            ResultSeeder::class,
        ]);
    }
}
