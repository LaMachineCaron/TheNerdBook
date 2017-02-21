<?php

namespace App\Http\Controllers;

use App\Http\Traits\YoutubeTrait;
use Illuminate\Http\Request;

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
            $data += ['youtube_url' => $this->generateUrl()];
        }

        return view('home', $data);
    }
}
