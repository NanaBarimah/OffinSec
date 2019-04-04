<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('users/', 'UserController@index');
Route::post('users/add_user', 'UserController@store');
Route::get('users/{user}', 'UserController@show');
Route::put('users/update/{user}', 'UserController@update');
Route::put('users/activate', 'UserController@is_active');

Route::post('/client/add', 'ClientController@store')->name('client.add');
Route::post('/sites/add', 'SiteController@store')->name('site.add');
Route::post('/guard/add', 'GuardController@store')->name('guard.add');