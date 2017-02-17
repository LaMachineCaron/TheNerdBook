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
        //TwitchApi::getAccessToken();
    }

    public function loginTwitch(Request $request){

        /*$token_key = $request->session()->get('authToken');
        if ($token_key == $request['state']) {
            $ch = curl_init(TwitchApi::getAuthenticationUrl());
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $data = curl_exec($ch);
            $response = json_decode($data, true);
            $accessToken = $response['access_token'];
            dd($accessToken);
        }*/

        $token = $this->auth($request['code']);

        //$token['refresh_token'];

        return view('testConnectionTwitch');
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
