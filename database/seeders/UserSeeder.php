<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 20; $i++) {
            User::create([
                    'name' => $faker->sentence(3),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => 'user',
                    'gender' => $faker->randomElement(['male', 'female', 'other']),

            ]);
        }
    }
}