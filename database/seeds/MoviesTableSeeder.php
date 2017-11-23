<?php

use Illuminate\Database\Seeder;
use App\Movies;
class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	/*Movies::truncate();
        $faker = \Faker\Factory::create();
		// And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Movies::create([
            	'idmovie' => $faker->randomDigitNotNull,
            	'user'=>0,
                'titulo' => $faker->sentence,
                'sinopsis' => $faker->paragraph,
                'imagen' => $faker->sentence,
            ]);
        }*/
    }
}
