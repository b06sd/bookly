<?php

use App\Book;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $prefix = 'BLK';
        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'title' => $faker->name,
                'ISBN' => $prefix.$faker->numberBetween($min = 1000000000, $max = 9999999999),
                'publisher' => $faker->name,
                'publication_year' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }
    }
}
