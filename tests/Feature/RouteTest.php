<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ExampleTest
 *
 * Class that tests the access to routes.
 *
 * @author Res260
 * @created_at 170214
 * @modified_at 170214
 */
class RouteTest extends TestCase
{
	use DatabaseTransactions;

	public function testCanAccessHomePage()
	{
		$response = $this->get('/');

		$response->assertStatus(200);
	}

	public function testLoginPageRedirection()
	{
		$response = $this->get('/login');
		$response->assertStatus(302);
	}

	public function testCanRegister()
	{
		$user = factory(User::class, 1)->make()[0];
		$user_array = $user->toArray();
		$user_array['password'] = 'secret';
		$user_array['password_confirmation'] = 'secret';
		array_forget($user_array, 'remember_token');
		$response = $this->call('POST', '/register', $user_array);
		$response->assertRedirect('/home');
		$this->seeIsAuthenticated();
		$this->assertDatabaseHas('users',
			[
                'first_name' => $user_array['first_name'],
				'last_name' => $user_array['last_name'],
				'email' => $user_array['email']
			]);
	}

	public function testCanLogin()
	{
		$user = factory(User::class, 1)->create()[0];
		$this->dontSeeIsAuthenticated();
		$response = $this->call('POST', '/login', ['email' => $user->email, 'password' => 'secret']);
		$response->assertRedirect('/home');
		$this->seeIsAuthenticatedAs($user);
	}
}
