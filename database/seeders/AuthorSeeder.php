<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Author::create([
'first_name' => $faker->word(),
'last_name' => $faker->word(),
'bio' => $faker->sentence(),

            ]);
        }
    }
}
