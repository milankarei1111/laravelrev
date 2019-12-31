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


Route::group(['prefix' => 'login', 'namespace' => 'Auth'], function ($provider) {
    Route::get('/{provider}', 'LoginController@redirrectProvder');
    Route::get('{provider}/callback', 'LoginController@handleProviderCallback');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    // 管理者
    Route::group(['as'=>'admin.','middleware' => 'admin', 'prefix' => 'admin'], function (){

        Route::resource('/user', 'Backend\AdminController');

    });

    // 主管
    Route::group(['middleware' => 'boss'], function (){
        Route::get('/boss', function () {
            return view('boss');
        });
    });
    Route::get('/user', function () {
        return view('user');
    });
});

Route::post('videos/upload', 'VideoController@upload')->name('videos.upload');
Route::resource('/posts', 'Backend\PostController');

