<?php

namespace App\Http\Controllers;


use App\User;
use Input;
use Request;

class HomeController extends Controller
{
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
        return view('home');
    }

    public function test()
    {
        $input = Request::input('search');

        $users = User::all();

        $foundUsers = User::where('first_name', 'LIKE', '%'.$input.'%')
                            ->orWhere('last_name', 'LIKE', '%'.$input.'%')
                            ->get();


        return view('test', compact('foundUsers'));
    }
}
