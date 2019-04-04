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
    return view('auth/login');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/users/add', 'UserController@create')->name('user.add');
Route::post('/users/activate', 'UserController@is_active')->name('user.active');
Route::get('/users', 'UserController@index')->name('user.index');
Route::get('/clients', 'ClientController@index')->name('clients');
Route::get('/client/{id}', 'ClientController@view')->name('client');

Route::get('/attendance', 'AttendanceController@view')->name('view.attendance');
Route::get('/guards', 'GuardController@index')->name('guards');
Route::get('/guards/add', 'GuardController@create')->name('guard.add');
Route::get('/guard/{id}', 'GuardController@view')->name('guard.view');
