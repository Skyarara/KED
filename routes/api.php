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

//login
Route::post('login', 'API\LoginController@login');
//space
Route::group(['middleware' => 'auth:api'], function () {
    //job activity
    Route::get('job_activity', 'API\DailyActivityController@index');
    Route::get('job_activity/detail', 'API\DailyActivityController@detail');
    Route::post('job_activity/tambah', 'API\DailyActivityController@add');
    //times
    Route::post('time/tambah', 'API\TimeController@add');
    Route::post('time/update_pause', 'API\TimeController@update_pause');
    Route::post('time/update_stop', 'API\TimeController@update_stop');
    //job category
    Route::get('job_category', 'API\JobCategoryController@data');
    //station
    Route::get('station', 'API\StationController@data');
    //logout
    Route::post('logout', 'API\LoginController@logout');
});
