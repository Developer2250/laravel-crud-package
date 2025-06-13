<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Book::create([
'title' => $faker->word(),
'author_id' => \App\Models\Author::inRandomOrder()->value('id') ?? 1,
'published_date' => $faker->date('Y-m-d'),
'isbn' => $faker->word(),
'summary' => $faker->sentence(),

            ]);
        }
    }
}