<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            [
                'phone' => '01825712671',
            ],
            [
                'name' => 'Mirza Md. Golam Nabi',
                'brand' => 'Coaching Center',
                'email' => 'golamnabi411330@gmail.com',
                'password' => Hash::make('12345'),
                'user_type_id' => 1,
            ]
        );

        User::firstOrCreate(
            [
                'phone' => '01914883581',
            ],
            [
                'name' => 'Mirza Md. Golam Nabi',
                'brand' => 'Coaching Center',
                'email' => 'golamnabi411330@gmail.com',
                'password' => Hash::make('12345'),
                'user_type_id' => 2,
            ]
        );

    }
}
