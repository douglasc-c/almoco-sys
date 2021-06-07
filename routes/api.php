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
    Route::put('user/token', 'Mobile\UserController@changeToken');
    
    // User
    Route::get('food/order/list', 'Mobile\MenuController@listMenuWeek');
    Route::post('food/order/create', 'Mobile\MenuController@createOrder');
    Route::put('food/order/update', 'Mobile\MenuController@updateOrder');
    Route::put('food/order/delete', 'Mobile\MenuController@deleteOrder');
    Route::get('food/order/historic', 'Mobile\MenuController@listHistoric');
    Route::post('food/order/justification', 'Mobile\MenuController@createJustification');
    Route::post('food/order/confirm', 'Mobile\MenuController@confirmLunch');

    // Arm
    Route::get('food/order/team', 'Mobile\MenuController@listTeam');
    Route::put('food/order/team/accept', 'Mobile\MenuController@acceptJustification');
    Route::put('food/order/team/deny', 'Mobile\MenuController@denyJustification');

    // Admin
    Route::get('food/order/admin/list', 'Mobile\MenuController@listCountFood');
    Route::get('food/order/notification/list', 'Mobile\NotificationController@index');
    Route::post('food/order/notification/create', 'Mobile\NotificationController@create');
    Route::put('food/order/notification/update', 'Mobile\NotificationController@update');
    Route::put('food/order/notification/delete', 'Mobile\NotificationController@delete');
    Route::post('food/order/notification/send', 'Mobile\NotificationController@send');
});
