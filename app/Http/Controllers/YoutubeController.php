<?php

namespace App\Http\Controllers;

use Google_Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class YoutubeController extends Controller {
	public function callback(Request $request) {
		$client = new Google_Client();
		$client->setHttpClient(new Client(array(
			'verify' => false,
		)));
		$client->setAuthConfig(public_path('client_secrets.json'));
		$client->setRedirectUri(route('youtubeCallback'));
		$client->setAccessType("offline");        // offline access
		$client->authenticate($request->input('code'));
		return redirect()->back();
	}
}
