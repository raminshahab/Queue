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
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('auth/logout', 'Auth\AuthController@logout');

Route::get('queue/email', 'MailQueueController@sendJob');
Route::get('job', 'JobPriorityController@getJobs');
Route::get('job/{id}', 'JobPriorityController@getJobStatus');
