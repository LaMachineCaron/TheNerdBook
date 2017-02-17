<?php

namespace App\Http\Traits;

use Auth;
use Google_Client;
use Google_Service_YouTube;

/**
 * Class YoutubeTrait
 *
 * Class containing useful methods for using the Youtube API
 *
 * @package App\Http\Traits
 * @author ZeLarpMaster
 */
trait YoutubeTrait {
	/**
	 * Generate and return an url to log into Youtube
	 * The url automatically sets the refresh token and
	 * 		goes back to where the user was
	 *
	 * @return string  The URL for the Youtube connection
	 */
	public function generateUrl() {
		$client = new Google_Client();
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setAccessType("offline");        // offline access
		$client->setIncludeGrantedScopes(true);   // incremental auth
		$client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
		$client->setRedirectUri(route('youtubeCallback'));
		return $client->createAuthUrl();
	}

	/**
	 * Check whether or not the currently logged in user has a connection token
	 *
	 * @return bool  True if the user has a refresh token
	 */
	public function isLoggedInYoutube() {
		return Auth::user()->token_youtube !== null;
	}
}
