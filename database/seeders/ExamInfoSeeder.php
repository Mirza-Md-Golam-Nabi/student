<?php

namespace Database\Seeders;

use App\Models\ExamInfo;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ExamInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        ExamInfo::firstOrCreate([
            'root_id' => 2,
            'name' => 'Mathematics Part 01',
            'subject_id' => 1,
            'class_id' => 11,
            'total_marks' => 20,
            'topic' => $faker->sentence(10),
            'exam_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'status' => 0,
            'updated_by' => 2,
        ]);

        ExamInfo::firstOrCreate([
            'root_id' => 2,
            'name' => 'Physics Part 01',
            'subject_id' => 2,
            'class_id' => 11,
            'total_marks' => 25,
            'topic' => $faker->sentence(10),
            'exam_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'status' => 1,
            'updated_by' => 2,
        ]);

        ExamInfo::firstOrCreate([
            'root_id' => 2,
            'name' => 'Mathematics Part 02',
            'subject_id' => 1,
            'class_id' => 11,
            'total_marks' => 20,
            'topic' => $faker->sentence(10),
            'exam_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'status' => 1,
            'updated_by' => 2,
        ]);
    }
}
