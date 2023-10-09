<?php

namespace Database\Seeders;

use App\Models\Result;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 30 fake result
        for ($i = 0; $i < 30; $i++) {
            Result::create([
                'root_id' => 2,
                'exam_info_id' => $i % 3 == 0 ? 3 : $i % 3,
                'student_id' => $i % 10 == 0 ? 10 : $i % 10,
                'get_marks' => $faker->numberBetween(10, 20),
                'updated_by' => 2,
            ]);
        }

    }
}
