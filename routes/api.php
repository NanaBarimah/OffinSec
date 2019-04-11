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
Route::post('users/add', 'UserController@store');
Route::get('users/{user}', 'UserController@show');
Route::put('users/update/{user}', 'UserController@update');
Route::put('users/activate', 'UserController@is_active');
Route::post('/user/toggle-active', 'UserController@toggleActive')->name('user.toggle');

Route::post('/client/add', 'ClientController@store')->name('client.add');
Route::post('/sites/add', 'SiteController@store')->name('site.add');
Route::post('/guard/add', 'GuardController@store')->name('guard.add');
Route::get('/attendance', 'AttendanceController@getAttendanceByDate')->name('attendance');
Route::post('/attendance/add', 'AttendanceController@store')->name('attendance.add');
Route::post('/duty_roster/add', 'DutyRosterController@store')->name('duty_roster.add');
Route::post('/duty_roster/add_to_roster', 'DutyRosterController@add_guard')->name('duty_roster.add');
Route::post('/offences/record', 'DeductionController@deductGuard')->name('offences.record');
Route::post('/offences/add', 'DeductionController@store')->name('offences.add');
Route::post('/permission/approval', 'PermissionController@approval')->name('permissions.approval');