<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;
use App\Http\Traits\TwitchTrait;

use App\Models\Post;
use App\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
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
            $data['videos'] = $this->getVideos();
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

    public function create_post_stream(Request $request)
    {
        $stream = json_decode($request->input('stream'), true);
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->type = 1;
        $post->caption = $request->input('caption');
        $post->title = $stream['channel']['status'];
        $post->channel_name = $stream['channel']['name']; //Not using display_name
        $post->game_title = $stream['game'];
        if ($post->save()) {
            return redirect()->back()->with('status', 'Le post a été créé.');
        } else {
            return redirect()->back()->withErrors('Erreur de sauvegarde du post.');
        }
    }

    public function create_post_video(Request $request)
    {
        $video = json_decode($request->input('video'), true);
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->type = 2;
        $post->caption = $request->input('caption');
        $post->title = $video['snippet']['title'];
        $post->channel_name = $video['snippet']['channelTitle'];
        $post->url = $video['id']['videoId'];
        if ($post->save()) {
            return redirect()->back()->with('status', 'Le post a été créé.');
        } else {
            return redirect()->back()->withErrors('Erreur de sauvegarde du post.');
        }
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
