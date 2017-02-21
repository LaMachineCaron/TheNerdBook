<?php

namespace App\Http\Traits;

use Auth;
use TwitchApi;

/**
 * Class TwitchTrait
 *
 * Class containing useful methods for using the Twitch API
 *
 * @package App\Http\Traits
 * @author ZeLarpMaster
 */
trait TwitchTrait {
	/**
	 * Generate and return an url to log into Twitch
	 * The url automatically sets the refresh token and
	 * 		goes back to where the user was
	 *
	 * @return string  The URL for the Twitch connection
	 */
	public function generateTwitchUrl() {
		return TwitchApi::getAuthenticationUrl();
	}

	/**
	 * Check whether or not the currently logged in user has a connection token
	 *
	 * @return bool  True if the user has a refresh token
	 */
	public function isLoggedInTwitch() {
		return Auth::user()->token_twitch !== null;
	}

	/**
	 * Return the Twitch API access token
	 *
	 * @return array  The Twitch API access token
	 */
	public function getAccessTokenTwitch(): array {
		return Auth::user()->token_twitch;
	}
}
