<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;
use App\User;
use TwitchApi;
use Zarlach\TwitchApi\API\Authentication;

class TwitchAPIS extends Controller
{

    public function connection(){
        return Redirect(TwitchApi::getAuthenticationUrl());
    }

    public function loginTwitch(Request $request){
        $token = $this->auth($request['code']);

        $user = Auth::user();

        $user->token_twitch = $token['refresh_token'];
        $user->save();

        return redirect()->back();
    }

    private function auth($code){
        $auth = new Authentication();

        // GuzzleHttp Client with default parameters.
        $client = new Client([
            'base_uri' => 'https://api.twitch.tv/kraken/',
            "verify" => false
        ]);

        $options = [
            'client_secret' => config('twitch-api.client_secret'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'state' => null,
            'redirect_uri' => config('twitch-api.redirect_url'),
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
        $response = $client->send($request);

        // Return body in JSON data
        return json_decode($response->getBody(), true);
    }



}
