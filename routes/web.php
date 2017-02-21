<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(Auth::check()) {
		return Redirect::to('/home');
	}
    return view('welcome');
});

Route::get('login', function () {
    return Redirect::to('/');
});

Route::get('register', function () {
    return Redirect::to('/');
});

Route::get('user/{id}', 'UserController@show');

Route::get('follow/{id}', 'UserController@follow');

Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout');

Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => ['auth']], function() {
    Route::get('home', 'HomeController@index');
	Route::get('/youtube/callback', 'YoutubeController@callback')->name('youtubeCallback');
    Route::get('/oauthtoken','TwitchAPIS@loginTwitch');
    Route::get('/test', 'HomeController@test');
});
