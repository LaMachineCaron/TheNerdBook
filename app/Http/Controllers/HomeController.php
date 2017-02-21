<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;
use App\Http\Traits\TwitchTrait;

use App\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Request;
use TwitchApi;

class HomeController extends Controller
{

use YoutubeTrait;
use TwitchTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        if ($this->isLoggedInYoutube()) {
            $data += ['videos' => ''];
        } else {
            $data += ['youtube_url' => $this->generateYoutubeUrl()];
        }

        try {
            if ($this->isLoggedInTwitch()) {
                $data += ['streams' => $this->getFollowedStreams()];
            } else {
                $data += ['twitch_url' => $this->generateTwitchUrl()];
            }


        } catch(ClientException $e){
            Auth::user()->token_twitch = null;
            Auth::user()->save();

            return redirect()->back();
        }

        return view('home', compact('data'));
    }

    public function test()
    {
        $input = Request::input('search');

        $users = User::all();

        $foundUsers = User::where('first_name', 'LIKE', $input.'%')
                            ->orWhere('last_name', 'LIKE', $input.'%')
                            ->orderBy('first_name','ASC')
                            ->get();


        return view('test', compact('foundUsers', 'input'));
    }
}
