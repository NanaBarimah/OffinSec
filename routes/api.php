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
Route::put('/user/update', 'UserController@update')->name('user.update');
Route::put('/user/update/my-account', 'UserController@myAccount')->name('user.update.my-account');
Route::put('users/activate', 'UserController@is_active');
Route::post('/user/toggle-active', 'UserController@toggleActive')->name('user.toggle');

Route::post('/client/add', 'ClientController@store')->name('client.add');
Route::get('/client/report', 'ClientController@report')->name('client.report');
Route::post('/client/update', 'ClientController@update')->name('client.update');
Route::put('/client/change-duration', 'ClientController@changeDate')->name('client.change-duration');
Route::delete('/client/delete/{client}', 'ClientController@destroy')->name('client.delete');
Route::post('/sites/add', 'SiteController@store')->name('site.add');
Route::put('/site/update', 'SiteController@update')->name('site.update');
Route::post('/guard/add', 'GuardController@store')->name('guard.add');
Route::put('/guard/update', 'GuardController@update')->name('guard.update');
Route::delete('/guard/delete/{guard}', 'GuardController@destroy')->name('guard.delete');
Route::get('/attendance', 'AttendanceController@getAttendanceByDate')->name('attendance');
Route::post('/attendance/add', 'AttendanceController@store')->name('attendance.add');
Route::post('/duty_roster/add', 'DutyRosterController@store')->name('duty_roster.add');
Route::post('/duty_roster/add_to_roster', 'DutyRosterController@add_guard')->name('duty_roster.add');
Route::delete('/remove-shift/delete', 'DutyRosterController@removeRoster')->name('duty_roster.remove');
Route::post('/offences/record', 'DeductionController@deductGuard')->name('offences.record');
Route::post('/offences/add', 'DeductionController@store')->name('offences.add');
Route::put('/offence/update', 'DeductionController@update')->name('offence.update');
Route::delete('/offence/delete/{deduction}', 'DeductionController@destroy')->name('offence.delete');
Route::post('/permission/approval', 'PermissionController@approval')->name('permissions.approval');
Route::post('/permission/approve-permission', 'PermissionController@reliever')->name('permissions.approve-guard');
Route::post('/report/send-report', 'ReportController@generateReport');
Route::get('/deductions/view', 'DeductionController@viewMonthly');

Route::get('/site/get', 'SiteController@setupApp')->name('site.get');
Route::post('/permissions/add', 'PermissionController@store')->name('permission.add');
Route::post('/report/send-mail', 'ReportController@sendMail');

Route::get('/guards/reports/age', 'GuardController@getGuardsByAgeRange');
Route::get('/guards/reports/gender', 'GuardController@getGuardsByGender');
Route::get('/guards/reports/site', 'GuardController@getGuardsBySite');

Route::post('/access-code/add', 'AccessCodeController@store')->name('access_code.add');
Route::post('/access-code/send-token', 'AccessCodeController@sendToken');
Route::put('/access-code/reset', 'AccessCodeController@resetCode')->name('access_code.reset');