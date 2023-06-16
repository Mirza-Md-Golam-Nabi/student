<?php

namespace Database\Seeders;

use App\Models\StudentInfo;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class StudentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 fake student
        for ($i = 0; $i < 10; $i++) {
            StudentInfo::create([
                'root_id' => 2,
                'name' => $faker->name,
                'phone' => '01' . $faker->numberBetween(100000000, 999999999),
                'class_id' => $faker->numberBetween(8, 11),
                'father_name' => $faker->name('male'),
                'mother_name' => $faker->name('female'),
                'school_name' => $faker->company,
                'guardian_phone' => '01' . $faker->numberBetween(100000000, 999999999),
                'status' => $faker->numberBetween(0, 1),
            ]);
        }
    }
}
