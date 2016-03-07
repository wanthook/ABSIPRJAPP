<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', ['as' => 'home.root','uses' => 'HomeController@index']);    
    Route::get('dashboard', ['as' => 'home.dashboard','uses' => 'HomeController@dashboard']);
    
    //Route::resource('alasan','AlasanController');
    
    Route::get('alasan', ['as' => 'alasan.tabel','uses' => 'AlasanController@alasanViewTable']);
    Route::post('alasan', ['as' => 'alasan.tabel','uses' => 'AlasanController@alasanDataTable']);
    Route::get('alasan/tambah', ['as' => 'alasan.tambah','uses' => 'AlasanController@alasanFormTable']);
//    Route::get('alasan/form', 'AlasanController@alasanFormTable');
});
