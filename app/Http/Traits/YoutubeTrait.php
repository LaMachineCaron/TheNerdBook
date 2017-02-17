<?php

namespace App\Http\Traits;

use Google_Client;
use Google_Service_YouTube;

/**
 * Class YoutubeTrait
 *
 * Class containing useful methods for using the Youtube API
 *
 * @package App\Http\Traits
 */
trait YoutubeTrait {
	public function generateUrl() {
		$client = new Google_Client();
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setAccessType("offline");        // offline access
		$client->setIncludeGrantedScopes(true);   // incremental auth
		$client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
		$client->setRedirectUri(route('youtubeCallback'));
		return $client->createAuthUrl();
	}
}
