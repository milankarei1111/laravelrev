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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Auth')
    ->prefix('auth')
    ->middleware('api')
    ->group(function () {
        Route::match(['get', 'post'], '/user', 'AuthController@userData');
        Route::post('/login', 'AuthController@login');
        Route::post('/logout', 'AuthController@logout');
    });

// Route::namespace('API')->prefix('users')
//     ->middleware('api')
//     ->group(function () {
//         Route::match(['get', 'post'], '/', 'UserController@index');
//         Route::get('/{id}', 'UserController@show');
//         Route::post('/', 'UserController@store');
//         Route::put('/{id}', 'UserController@update');
//         Route::delete('/{id}', 'UserController@destroy');
//     });

    Route::apiResource('/users', 'API\UserController');
    Route::post('/users/v1/params', 'API\UserController@params');
