<?php

namespace App\Http\Controllers;

use App\Http\Traits\TwitchTrait;
use Auth;
use Illuminate\Http\Request;

class TwitchController extends Controller
{
	use TwitchTrait;

	/**
	 * Callback for the Twitch authentication
	 *
	 * @param Request  $request  Request containing the authentication code
	 * @return \Illuminate\Http\RedirectResponse  Goes back
	 */
	public function callback(Request $request){
		$token = $this->authTwitch($request['code']);

		$user = Auth::user();

		// TODO: Change to 'refresh_token' when Twitch changes their API
		$user->token_twitch = $token['access_token'];
		$user->save();

		return redirect()->back();
	}
}
