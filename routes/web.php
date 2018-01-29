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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
	    return view('home');
	});
});

Route::get('/login','Auth\LoginController@showLoginForm');
Route::get('/logout','Auth\LoginController@logout');
Route::post('/login','Auth\LoginController@login');