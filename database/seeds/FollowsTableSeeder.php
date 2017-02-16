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

        for ($i=0; $i < 16; $i++) {
        	$users = User::inRandomOrder()->limit(2)->get(); 
            DB::table('follows')->insert([
	            'user_id' => $users->get(0)->id,
	            'follower_id' => $users->get(1)->id,
        	]);
        }
    }
}
