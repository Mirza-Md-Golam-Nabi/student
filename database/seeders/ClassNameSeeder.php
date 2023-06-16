<?php

namespace Database\Seeders;

use App\Models\ClassName;
use Illuminate\Database\Seeder;

class ClassNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassName::firstOrCreate([
            'id' => 1,
            'title' => 'One',
        ]);

        ClassName::firstOrCreate([
            'id' => 2,
            'title' => 'Two',
        ]);

        ClassName::firstOrCreate([
            'id' => 3,
            'title' => 'Three',
        ]);

        ClassName::firstOrCreate([
            'id' => 4,
            'title' => 'Four',
        ]);

        ClassName::firstOrCreate([
            'id' => 5,
            'title' => 'Five',
        ]);

        ClassName::firstOrCreate([
            'id' => 6,
            'title' => 'Six',
        ]);

        ClassName::firstOrCreate([
            'id' => 7,
            'title' => 'Seven',
        ]);

        ClassName::firstOrCreate([
            'id' => 8,
            'title' => 'Eight',
        ]);

        ClassName::firstOrCreate([
            'id' => 9,
            'title' => 'Nine',
        ]);

        ClassName::firstOrCreate([
            'id' => 10,
            'title' => 'Ten',
        ]);

        ClassName::firstOrCreate([
            'id' => 11,
            'title' => 'Eleven',
        ]);

        ClassName::firstOrCreate([
            'id' => 12,
            'title' => 'Twelve',
        ]);
    }
}
