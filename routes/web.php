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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user', 'UserController@index')->name('user/index');

		// Routes users
Route::get('/api/v1/user', ['name' => 'api.user.profile', 'uses' => 'UserController@profile']);
//Route::get('/user', ['name' => 'user.profile', 'uses' => 'UserController@profile']);
Route::post('/user', ['name' => 'api.user.store', 'uses' => 'UserController@store']);
Route::put('/user/{id}', ['name' => 'api.user.update', 'uses' => 'UserController@update']);
Route::get('/user/show', ['name' => 'api.user.show', 'uses' => 'UserController@show']);
Route::get('/user/getdata/{id}', ['name' => 'api.user.getdata', 'uses' => 'UserController@getdata']);
Route::get('/user/delete', ['name' => 'api.user.delete', 'uses' => 'UserController@delete']);