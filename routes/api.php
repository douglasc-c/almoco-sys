<?php

use Illuminate\Support\Facades\Route;

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

Route::post('login', 'Mobile\AuthController@login');
Route::post('forgot', 'Mobile\AuthController@forgot')->name('password.reset');

Route::group(['middleware' => ['jwt.verify']], function () {
    // Auth
    Route::post('logout', 'Mobile\AuthController@logout');
    Route::get('refresh', 'Mobile\AuthController@refresh');
    Route::get('me', 'Mobile\AuthController@me');    
    
    Route::put('user/update', 'Mobile\UserController@update');
    
});
