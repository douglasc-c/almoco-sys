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

Route::any('payment/cryptoapis/check-payment/{order_id}/{address_coin}', function($order_id, $address_coin){
  header('Access-Control-Allow-Origin: *');
  App\Repositories\CryptoApisRepository::checkPayment($order_id, $address_coin);
});


Route::any('payment/tulus/check/{order_id}', function($order_id){
    header('Access-Control-Allow-Origin: *');
    App\Repositories\TulusPaymentRepository::checkStatus($order_id);
});

Route::any('payment/tulus/check-payment/{order_id}/{address_coin}', function($order_id, $address_coin){
    header('Access-Control-Allow-Origin: *');
    App\Repositories\TulusPaymentRepository::checkPayment($order_id, $address_coin);
});
