<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Check if the table exist.
     *
     * @test
     */
    public function check_table_users()
    {
        $this->assertTrue(Schema::hasTable('users'), "'users' table didn't exist.");
    }

    /**
     * Check if it's possible to save a user model in the database.
     *
     * @test
     */
    public function save_user_model()
    {
        $user = new User;
        $user->first_name = "Alexandre";
        $user->last_name = "Caron";
        $user->email = "alex.caron@gmail.com";
        $user->password = bcrypt("LaMachineCaron");
        $this->assertTrue($user->save());
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password
        ]);
    }
}
