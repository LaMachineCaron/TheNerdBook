<?php

namespace App\Http\Traits;

use Auth;
use TwitchApi;
use Zarlach\TwitchApi\API\Authentication;
use GuzzleHttp\Client;

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
     * Logout from Twitch
     */
    public function logoutTwitch() {
        Auth::user()->token_twitch = null;
        Auth::user()->save();
    }

	/**
	 * Return the Twitch API access token
	 *
	 * @return array  The Twitch API access token
	 */
	public function getAccessTokenTwitch(): array {
		return Auth::user()->token_twitch;
	}

	/**
	 * Configures and returns a Twitch Client
	 *
	 * @return Client  The initialized Client
	 */
	private function getTwitchClient(): Client {
		$client = new Client([
			'base_uri' => 'https://api.twitch.tv/kraken/',
			'verify' => false
		]);
		return $client;
	}

	/**
	 * Authenticates the user on the Twitch API using a code
	 *
	 * @param string  $code  The Twitch API code for authentication
	 * @return array  Array containing the refresh token and access token
	 */
	private function authTwitch($code){
		$auth = new Authentication();

		$options = [
			'client_secret' => config('twitch-api.client_secret'),
			'grant_type' => 'authorization_code',
			'code' => $code,
			'state' => null,
			'redirect_uri' => route('twitchCallback'),
		];

		$path = $auth->generateUrl('oauth2/token', false, $options, []);

		// Headers
		$data = [
			'headers' => [
				'Client-ID' => $auth->getClientId(),
				'Accept' => 'application/vnd.twitchtv.v3+json',
			],
		];

		// Request object
		$request = new \GuzzleHttp\Psr7\Request("POST", $path, $data);

		// Send request
		$response = $this->getTwitchClient()->send($request);

		// Return body in JSON data
		return json_decode($response->getBody(), true);
	}

	private function getFollowedStreams(){
        $client = $this->getTwitchClient();
        $auth = new Authentication();
        $data = [
            'headers' => [
                'Client-ID' => $auth->getClientId(),
                'Accept' => 'application/vnd.twitchtv.v3+json',
            ],
        ];
        $path = $auth->generateUrl('streams/followed', Auth::user()->token_twitch, [], []);
        $request = new \GuzzleHttp\Psr7\Request('GET', $path, $data);
        $response = $client->send($request);

        return json_decode($response->getBody(), true);
    }
}
