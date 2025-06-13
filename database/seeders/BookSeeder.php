<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US'); // Use US English locale

        for ($i = 0; $i < 20; $i++) {
            Book::create([
'title' => $faker->sentence(3),
'author_id' => \App\Models\Author::inRandomOrder()->value('id') ?? 1,
'published_date' => $faker->date('Y-m-d'),
'isbn' => $faker->isbn13(),
'summary' => $faker->realText(100),
            ]);
        }
    }
}