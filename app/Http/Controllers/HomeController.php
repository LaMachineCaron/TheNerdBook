<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;


use App\User;
use Illuminate\Support\Facades\Input;

use Request;

class HomeController extends Controller
{

use YoutubeTrait;

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
