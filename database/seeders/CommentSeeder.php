<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US');

        for ($i = 0; $i < 20; $i++) {
            Comment::create([
                    'post_id' => \App\Models\Post::inRandomOrder()->value('id') ?? 1,
                    'user_id' => \App\Models\User::inRandomOrder()->value('id') ?? 1,
                    'body' => $faker->realText(100),

            ]);
        }
    }
}