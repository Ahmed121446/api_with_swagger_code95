<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\User;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create('uk_UA');
		for ($i=1; $i <= 20 ; $i++) { 
			DB::table('items')->insert([
				'image_path' => $faker->image('public/storage/Itemsimages',  200,  300, null, false),
				'name' => $faker->name,
				'desc' => $faker->sentence,
				'price'=>$faker->numberBetween($min = 1, $max = 200),
				'user_id'=>App\User::all()->random()->id,
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
			]);
		}
    }
}
