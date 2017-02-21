<?php

namespace App\Http\Controllers;

use Auth;
use Google_Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

/**
 * Class YoutubeController
 *
 * Controller for the Youtube API Responses
 *
 * @package App\Http\Controllers
 * @author ZeLarpMaster
 */
class YoutubeController extends Controller {

	/**
	 * Callback for the Youtube API
	 * Authenticates the user and saves his refresh token
	 *
	 * @param Request  $request  Response from the Youtube API
	 * @return \Illuminate\Http\RedirectResponse  Back to where the user was
	 */
	public function callback(Request $request) {
		$client = new Google_Client();
		$client->setHttpClient(new Client(array(
			'verify' => false,
		)));
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setRedirectUri(route('youtubeCallback'));
		$client->setAccessType("offline");        // offline access
		$client->authenticate($request->input('code'));
		Auth::user()->token_youtube = $client->getRefreshToken();
		Auth::user()->save();
		return redirect()->back();
	}
}
