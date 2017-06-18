<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();


Route::group(['middleware' => ['web','auth']], function () {

	Route::get('/', function () {

		$user = Auth::user();
    	return View::make('home')->with('user',$user);
	});

	Route::get('/home', function () {
		$user = Auth::user();
    	return View::make('home')->with('user',$user);
	});

	Route::get('/error/{info?}', 'HomeController@error')->name('error');

	Route::get('/profile/{id?}', 'ProfileController@index');

	Route::get('/send_request/{id?}', 'RelationsController@index');

});