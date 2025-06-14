<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_US'); // Use US English locale

        for ($i = 0; $i < 20; $i++) {
            Product::create([
'name' => $faker->sentence(3),
'price' => $faker->randomFloat(2, 1, 1000),
'description' => $faker->realText(100),
            ]);
        }
    }
}