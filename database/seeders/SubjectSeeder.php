<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::firstOrCreate([
            'root_id' => 2,
            'name' => 'Mathematics',
        ]);

        Subject::firstOrCreate([
            'root_id' => 2,
            'name' => 'Physics',
        ]);

    }
}
