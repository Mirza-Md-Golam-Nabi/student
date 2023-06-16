<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::firstOrCreate([
            'title' => 'Super Admin',
        ]);

        UserType::firstOrCreate([
            'title' => 'Admin',
        ]);

        UserType::firstOrCreate([
            'title' => 'Editor',
        ]);

        UserType::firstOrCreate([
            'title' => 'Guardian',
        ]);

        UserType::firstOrCreate([
            'title' => 'Student',
        ]);
    }
}
