<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->delete();

        $user->

        for ($i=0; $i < 16; $i++) { 
            DB::table('follows')->insert([
	            'first_name' => str_random(10),
	            'last_name' => str_random(10),
	            'email' => str_random(10).'@gmail.com',
	            'password' => bcrypt('secret'),
        	]);
        }
    }
}
