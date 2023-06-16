<?php

namespace Database\Seeders;

use App\Models\Cls;
use Illuminate\Database\Seeder;

class ClsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cls::firstOrCreate([
            'root_id' => 2,
            'class_name_id' => 8,
        ]);

        Cls::firstOrCreate([
            'root_id' => 2,
            'class_name_id' => 9,
        ]);

        Cls::firstOrCreate([
            'root_id' => 2,
            'class_name_id' => 10,
        ]);

        Cls::firstOrCreate([
            'root_id' => 2,
            'class_name_id' => 11,
        ]);
    }
}
