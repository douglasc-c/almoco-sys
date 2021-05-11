<?php namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Order;
use App\User;
use App\Payment;
use App\Coin;
use DB;

class TulusPaymentRepository
{
    public static $config = [
      'api_key' => 'J3H-32j12j30-fjsd',
      'postback_url' => 'https://wallet.etherpay.tech/payment/tulus/postback',
    ];

    public function createCheckout($order)
    {
        $verify_order = Payment::where('order_id', $order->id)->first();

        if($verify_order){
            //$url_checkout = $verify_order->url;
            return '<div style="min-height: 20px;padding: 19px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=bitcoin:'.$verify_order->address.'?amount='.$verify_order->value_coin.'&choe=UTF-8" class="img-responsive" style="width: auto;height: 150px;">
                        </div>
                        <div class="col-md-8">
                          <h4 style="color:#333">Bitcoin Payment</h4>
                          <p>Sent <b>'.$verify_order->value_coin.'</b> to address<br />
                            <div class="input-group mb-0">
                              <input type="text" id="btcAddressDeposit" class="form-control" value="'.$verify_order->address.'">
                              <span class="input-group-btn">
                              <button type="button" onclick="copyAddressFunction()" id="copyAddressDepositBtc" data-clipboard-action="copy" data-clipboard-target="#btcAddressDeposit" class="btn btn-success" alt="Copy to clipboard">copy</button>
                              </span>
                            </div>
                          </p>
                          <span class="badge badge-success" id="success" style="display:none;">Address Copy with success to Clipboard.</span>
                          <p>*You need sent the exact value in BTC.</p>
                          <p style="margin-bottom:0px;"><span id="PaymentStatus_'.$verify_order->address.'"></span></p>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="payment_boxID" value="'.$verify_order->address.'">
                    <script type="text/javascript">
                    $("#address_'.$verify_order->address.'").focus(function() {
                       $(this).select();
                    });
                    function updatePaymentStatus() {
                        btc_gateway_update_status("'.$verify_order->address.'");
                        btc_gateway_check_payment_status("'.$verify_order->address.'");
                    }
                    setInterval(updatePaymentStatus,3000);
                    </script>';
        }

        $total = substr($order->total, 0, -2);
        $price =  Coin::where('symbol','ETHPY')->first()->price_usd;
        $total =  $total * $price;

        // Add + $5
        $total = $total + 5;

        $data = array(
          'api_key' => TulusPaymentRepository::$config['api_key'],
          'value' => $total,
          'postback_url' => TulusPaymentRepository::$config['postback_url']
        );

        $data = http_build_query($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://tulus.io/api/checkout/create",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);

        if($response && $response->status){

            if(!DB::table('payments')->where('order_id', $order->id)->first()){
                DB::table('payments')->insert([
                    'order_id' => $order->id,
                    'processor_name' => 'tulus',
                    'url' => $response->checkout_url,
                    'processor_id' => $response->token,
                    'address' => $response->address,
                    'value_coin' => $response->value_btc,
                    'status' => '0',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }

            //$checkout_url = '<a class="btn btn-success" target="_blank" href="'.$response->checkout_url.'">Go to Tulus Checkout</a>';
            $verify_order = DB::table('payments')->where('order_id', $order->id)->first();

            return '<div style="min-height: 20px;padding: 19px;background-color: #f5f5f5;border: 1px solid #e3e3e3;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">
                      <div class="row">
                        <div class="col-md-4">
                          <img src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=bitcoin:'.$verify_order->address.'?amount='.$verify_order->value_coin.'&choe=UTF-8" class="img-responsive" style="width: auto;height: 150px;">
                        </div>
                        <div class="col-md-8">
                          <h4 style="color:#333">Bitcoin Payment</h4>
                          <p>Sent <b>'.$verify_order->value_coin.'</b> to address<br />
                            <div class="input-group mb-0">
                              <input type="text" id="btcAddressDeposit" class="form-control" value="'.$verify_order->address.'">
                              <span class="input-group-btn">
                              <button type="button" onclick="copyAddressFunction()" id="copyAddressDepositBtc" data-clipboard-action="copy" data-clipboard-target="#btcAddressDeposit" class="btn btn-success" alt="Copy to clipboard">copy</button>
                              </span>
                            </div>
                          </p>
                          <span class="badge badge-success" id="success" style="display:none;">Address Copy with success to Clipboard.</span>
                          <p>*You need sent the exact value in BTC.</p>
                          <p style="margin-bottom:0px;"><span id="PaymentStatus_'.$verify_order->address.'"></span></p>
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="payment_boxID" value="'.$verify_order->address.'">
                    <script type="text/javascript">
                    $("#address_'.$verify_order->address.'").focus(function() {
                       $(this).select();
                    });
                    function updatePaymentStatus() {
                        btc_gateway_update_status("'.$verify_order->address.'");
                        btc_gateway_check_payment_status("'.$verify_order->address.'");
                    }
                    setInterval(updatePaymentStatus,3000);
                    </script>';

            return $checkout_url;
        }
    }

    

    public static function checkPayment($order_id, $forwarding_address){
        $order = Order::find($order_id);
        if ($order->status_id == 1){
            $url = 'https://blockchain.info/q/getreceivedbyaddress/' . $forwarding_address;
            $get = file_get_contents($url);
            $object = json_decode($get);

            $total_address = $object / 100000000;
            $payment = Payment::where('order_id', $order->id)->first();
            $order_total = ($payment->value_coin != 0) ? $payment->value_coin * 0.9 : $order_to_btc;

            if($total_address >= $order_total){
                $payment->status = 1;
                if($payment->save()){
                  $order->updateHistoryStatus(6);
                  $order->executeWhenOrderIsPaid();
                }
                return response()->json(['status' => true], 200);
            }
            return response()->json(['status' => false], 404);
        }
        return response()->json(['status' => false], 404);
    }

    public static function checkPaymentCron($order_id, $forwarding_address){
        $order = Order::find($order_id);
        if ($order->status_id == 1){
            $url = 'https://blockchain.info/q/getreceivedbyaddress/' . $forwarding_address;
            $get = file_get_contents($url);
            $object = json_decode($get);

            $total_address = $object / 100000000;
            $payment = Payment::where('order_id', $order->id)->first();
            $order_total = ($payment->value_coin != 0) ? $payment->value_coin * 0.9 : $order_to_btc;

            if($total_address >= $order_total){
                $payment->status = 1;
                if($payment->save()){
                  $order->manual = 0;
                  $order->save();
                  $order->updateHistoryStatus(6);
                  $order->executeWhenOrderIsPaid();
                  
                }
                return true;
            }
            return false;
        }
        return false;
    }

    public static function checkStatus($order_id)
    {
        $payment = Payment::where('order_id', $order_id)->first();
        if($payment && $payment->status > 0){
            echo '<span class="text text-success"><i class="fa fa-check"></i> Payment was received! Your payment was processed.</span>';
        } else {
            echo '<span class="text text-info"><i class="fa fa-spin fa-spinner"></i> Awaiting payment...';
        }
    }

    public static function createWithdrawal($destination, $value)
    {
      $amount = file_get_contents('https://blockchain.info/tobtc?currency=USD&value=' . $value);

      $data = array(
        'api_key' => TulusPaymentRepository::$config['api_key'],
        'type' => 'BTC',
        'value' => $amount, //BTC
        'destination' => $destination
      );

      $data = http_build_query($data);

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://tulus.io/api/withdrawal/create",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/x-www-form-urlencoded",
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      $response = json_decode($response);

      if($response && $response->status){
        return true;
      }

      return false;
    }

    public static function getData(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://tulus.io/api/address/btc/38jBieXsg6aooTtrboZLVadTSE2qyL8jtm",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $balance_tulus_wallet = json_decode($response);

        return $balance_tulus_wallet;
    }
}