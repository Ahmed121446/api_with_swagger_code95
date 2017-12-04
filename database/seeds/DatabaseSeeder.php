<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->truncate();
        DB::table('items')->truncate();

        
    	//$this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
