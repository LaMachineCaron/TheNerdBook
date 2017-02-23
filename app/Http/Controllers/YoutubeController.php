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
			Auth::user()->refresh_token_youtube = $token['refresh_token'];
		}
		unset($token['refresh_token']);
		Auth::user()->access_token_youtube = json_encode($token);
		Auth::user()->save();
		return redirect()->back();
	}
}
