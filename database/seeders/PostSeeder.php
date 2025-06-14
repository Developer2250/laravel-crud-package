<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 20; $i++) {
            Post::create([
                    'user_id' => \App\Models\User::inRandomOrder()->value('id') ?? 1,
                    'title' => $faker->sentence(3),
                    'content' => $faker->realText(100),

            ]);
        }
    }
}