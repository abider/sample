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

Route::get('home', 'StaticPagesController@home')->name('home');
Route::get('about', 'StaticPagesController@about')->name('about');
Route::get('help', 'StaticPagesController@help')->name('help');

Route::get('signup', 'UsersController@create')->name('signup');
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::resource('users', 'UsersController');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('email.confirm');
