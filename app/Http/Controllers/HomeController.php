<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;
use App\Http\Traits\TwitchTrait;

use App\User;
use App\Models\Post;
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
    public function index($page = 1)
    {
        $postPerPage = 5;
        $data = [];
        $user = Auth::user();

        if ($this->isLoggedInYoutube()) {
            $this->getSubVideos();
            $data['videos'] = [];
        } else {
            $data['youtube_url'] = $this->generateYoutubeUrl();
        }

        if ($this->isLoggedInTwitch()) {
            $data['streams'] = $this->getFollowedStreams();
        } else {
            $data['twitch_url'] = $this->generateTwitchUrl();
        }

        $posts = Post::With('comments.likes', 'likes')
            ->WhereIn('user_id', $user->following()
                ->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->limit($postPerPage)
            ->offset((($page - 1) * $postPerPage))
            ->get();
        $data['posts'] = $posts;

        return view('home', $data);
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
