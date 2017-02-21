<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = new User();
        $user->first_name = "Alex";
        $user->last_name = "Caron";
        $user->email = "alexandre@info.com";
        $user->password = bcrypt("allo123");
        $user->save();
        
        factory(User::class, 15)->create();
    }
}
