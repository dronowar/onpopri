<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('test', 'IndexController@getTest');

Route::get('/', 'IndexController@getIndex');
Route::controller('login', 'LoginController');
Route::get('home', array('before' => 'auth', 'uses' => 'HomeController@getIndex'));
Route::get('logout', function() {
    Auth::logout();
    return Redirect::to('/');
});
Route::controller('orderitem', 'OrderitemController');
Route::controller('order', 'OrderController');
