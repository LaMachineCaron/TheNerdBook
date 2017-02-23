<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;
use Auth;
use Illuminate\Http\Request;

/**
 * Class YoutubeController
 *
 * Controller for the Youtube API Responses
 *
 * @package App\Http\Controllers
 * @author ZeLarpMaster
 */
class YoutubeController extends Controller {

	use YoutubeTrait;

	/**
	 * Callback for the Youtube API
	 * Authenticates the user and saves his refresh token
	 *
	 * @param Request  $request  Response from the Youtube API
	 * @return \Illuminate\Http\RedirectResponse  Back to where the user was
	 */
	public function callback(Request $request) {
		$client = $this->getGoogleClient();
		$client->authenticate($request->input('code'));
		$token = $client->getAccessToken();
		if (isset($token['refresh_token'])) {
			Auth::user()->token_youtube = $token['refresh_token'];
			Auth::user()->save();
		}
		Auth::user()->setAccessTokenYoutube($token);
        $youtube = new \Google_Service_YouTube($client);
        $response = $youtube->subscriptions->listSubscriptions('id', ['mine' => true]);
        dd($response);
		return redirect()->back();
	}
}
