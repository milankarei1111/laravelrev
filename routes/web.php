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


Route::group(['prefix' => 'login/github', 'namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@redirrectProvder')->name('login.github');
    Route::get('/callback', 'LoginController@handleProviderCallback');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function (){
        Route::get('/auth', function () {
            return view('admin');
        });
    });
    Route::group(['middleware' => 'boss'], function (){
        Route::get('/boss', function () {
            return view('boss');
        });
    });
    Route::get('/user', function () {
        return view('user');
    });
});
