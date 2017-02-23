<?php

namespace App\Http\Traits;

use Auth;
use Google_Client;
use Google_Service_YouTube;
use GuzzleHttp\Client;
use Illuminate\Auth\Authenticatable;

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
	public function generateYoutubeUrl() {
		$client = $this->getGoogleClient();
		return $client->createAuthUrl();
	}

	/**
	 * Check whether or not the currently logged in user has a connection token
	 *
	 * @return bool  True if the user has a refresh token
	 */
	public function isLoggedInYoutube() {
		return Auth::user()->refresh_token_youtube !== null;
	}

	/**
	 * Refresh the access token if it's expired
	 *
	 * @return array  The Google Client access token
	 */
	public function getAccessTokenYoutube(): array {
		$client = $this->getGoogleClient();
		$client->setAccessToken(Auth::user()->getAccessTokenYoutube());
		if($client->isAccessTokenExpired()) {
			$new_token = $client->fetchAccessTokenWithRefreshToken(Auth::user()->token_youtube);
			$client->setAccessToken($new_token);
			Auth::user()->setAccessTokenYoutube($new_token);
		}
		return $client->getAccessToken();
	}

	/**
	 * Configures and returns a Google Client
	 *
	 * @return Google_Client  The initialized Google_Client
	 */
	private function getGoogleClient(): Google_Client {
		$client = new Google_Client();
		$client->setHttpClient(new Client(array(
			'verify' => false,
		)));
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setAccessType("offline");        // offline access
		$client->setIncludeGrantedScopes(true);   // incremental auth
		$client->addScope(Google_Service_YouTube::YOUTUBE_READONLY);
		$client->setRedirectUri(route('youtubeCallback'));
		return $client;
	}

	/**
	* Get the videos from your subs
	*/
	public function getSubVideos() {
		$this->getSubId();
		$this->getVideos();
	}

	/**
	* Get an array of your sub id
	*/
	private function getSubId() {
	    $client = $this->getAuthenticatedGoogleClient();
	    //$salut = Auth::user()->token_youtube;
        //Auth::user()->setAccessTokenYoutube($client->fetchAccessTokenWithRefreshToken(Auth::user()->token_youtube));
        //$client->setAccessToken($this->getAccessTokenYoutube());
        $youtube = new Google_Service_YouTube($client);
        //TODO: Change maxResult to handle if user has more than 50 subs.
        $response = $youtube->subscriptions->listSubscriptions('id', ['mine' => true, 'maxResults' => 50]);
	}

	public function getVideos() {
        $client = $this->getAuthenticatedGoogleClient();
        $youtube = new Google_Service_YouTube($client);
        $response = $youtube->subscriptions->listSubscriptions('id', ['mine' => true, 'maxResults' => 50]);
        dd($response);
    }
}
