<?php

// use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\JobActivities;


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

Route::get('admin', 'HomeController@admin');
Route::get('/login', 'HomeController@login_page')->name('login');
Route::post('/login_act', 'Auth\LoginController@authenticate')->name('login.act');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('role', 'RoleController');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    //User
    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/tambah_page', 'UserController@tambah_page')->name('user.tambah');
    Route::post('/user/tambah', 'UserController@tambah');
    Route::get('/user/ubah_page/{id}', 'UserController@ubah_page')->name('user.ubah');
    Route::post('/user/ubah/{id}', 'UserController@ubah');
    Route::post('/user/hapus', 'UserController@hapus')->name('user.hapus');
    Route::get('/user/{id}', 'UserController@show')->name('user.show');
    //Job Categories
    Route::get('/job_category', 'JobCategoryController@index')->name('job_category');
    Route::get('/job_category/tambah_page', 'JobCategoryController@tambah_page')->name('job_category.tambah');
    Route::post('/job_category/tambah', 'JobCategoryController@tambah');
    Route::get('/job_category/ubah_page/{id}', 'JobCategoryController@ubah_page')->name('job.category.ubah');
    Route::post('/job_category/ubah/{id}', 'JobCategoryController@ubah');
    Route::post('/job_category/hapus', 'JobCategoryController@hapus')->name('job_category.hapus');
    //Station
    Route::get('/station', 'StationController@index')->name('station');
    Route::get('/station/tambah_page', 'StationController@tambah_page')->name('station.tambah');
    Route::post('/station/tambah', 'StationController@tambah');
    Route::get('/station/ubah_page/{id}', 'StationController@ubah_page')->name('station.ubah');
    Route::post('/station/ubah/{id}', 'StationController@ubah');
    Route::post('/station/hapus', 'StationController@hapus');
    //Daily Activity
    Route::get('/daily_activity', 'DailyActivityController@index');
    Route::get('/daily_activity/delete/{id}', 'DailyActivityController@delete_job');
    Route::get('/daily_activity/detail/{id}', 'DailyActivityController@detail');
    Route::get('/daily_activity/detail/{id}/delete/{Id}', 'DailyActivityController@delete');
    Route::get('/daily_activity/detail/{id}/edit/{Id}', 'DailyActivityController@edit_page');
    Route::post('/daily_activity/detail/{id}/update/{Id}', 'DailyActivityController@update');
    Route::post('/daily_activity/export', 'DailyActivityController@export')->name('activity.excel');
});
