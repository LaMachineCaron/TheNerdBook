<?php

use Illuminate\Database\Seeder;

use App\User;

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

        for ($i=0; $i < 160; $i++) {
        	$users = User::inRandomOrder()->limit(2)->get();
        	try {
        		DB::table('follows')->insert([
		            'user_id' => $users->get(0)->id,
		            'follower_id' => $users->get(1)->id,
        		]);
        	} catch(Throwable $t) {

        	}
        }
    }
}
