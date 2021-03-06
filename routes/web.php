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
	if(auth()->check())
	{
		auth()->user()->live_status = 0;
        auth()->user()->save();
	}

return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/play-computer', 'PlayComputerController@index');

Route::get('/play-friend', 'PlayFriendController@index');

Route::get('/play-friend/{friendId}/{gameId}', 'PlayFriendController@index');

Route::get('/play-random', 'PlayRandomController@index');

Route::post('/play-random/disconnect/{friendId}/{gameId}', 'PlayRandomController@disconnect');

Route::get('/play-random/{friendId}/{gameId}', 'PlayRandomController@index');

Route::post('/user/game/stats', 'StatsController@index');

Route::get('/profile','UserController@profile');
Route::post('/profile','UserController@updateProfile');
Route::post('/password','UserController@updatePassword');


Route::get('/change-password','UserController@password');

Route::get('/wallet','UserController@wallet');

Route::get('/matche','UserController@matche');

Route::get('/tournaments', 'TournamentsController@index');


Route::get('/tournaments/{tournament}', 'TournamentsController@show');

Route::get('/tournaments/{tournament}/join', 'TournamentsController@join');


Route::get('/matches/{match}', 'TournamentsController@match');

Route::get('/matches/{match}/play', 'TournamentsController@play');

Route::post('/matches/{match}/{status}', 'TournamentsController@updateStatus');


Route::get('/profile/wallet', 'WalletController@index');
Route::post('/wallet/add', 'WalletController@add');
Route::get('/payment/response/', 'WalletController@response');


