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
    return view('welcome');
});

Route::get('login', function () {
    return Redirect::to('/');
});

Route::get('register', function () {
    return Redirect::to('/');
});

Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout');

Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => ['auth']], function() {
    Route::get('home', 'HomeController@index');
	Route::get('/youtube/callback', 'YoutubeController@callback')->name('youtubeCallback');
    Route::get('/oauthtoken','TwitchAPIS@loginTwitch');
});
