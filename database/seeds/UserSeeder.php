<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $Languages = [
        'ar_SA','uk_UA','zh_TW','ko_KR'
    ];

    for ($i=1; $i <= 10; $i++) { 
        $faker = Faker::create($Languages[0]);
        DB::table('users')->insert([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }


    // 	for ($i=1; $i <= 50; $i++) { 

    //         if ($i <= 10 ) {
    //             $faker = Faker::create($Languages[0]);
    //              DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->email,
    //             'password' => bcrypt('secret'),
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //         }else if ($i <= 20 && $i > 10) {
    //            $faker = Faker::create($Languages[1]);
    //             DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->email,
    //             'password' => bcrypt('secret'),
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //         }else if ($i <= 30 && $i > 20) {
    //             $faker = Faker::create($Languages[2]);
    //              DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->email,
    //             'password' => bcrypt('secret'),
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //         }else if ($i <= 40 && $i > 30) {
    //             $faker = Faker::create($Languages[3]);
    //              DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->email,
    //             'password' => bcrypt('secret'),
    //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //             'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
    //         ]);
    //         }


    
    // }
}
}
