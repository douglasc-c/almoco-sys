<?php

namespace App\Repositories;

use App\Payment;
use App\Order;
use DB;

class CryptoApisRepository
{
    public static $configGeneral = [
        'api_key' => '5d39c38225321a4bc9b1159dd4dedb49028f81b1',
        // 'contract' => '0x59C033Ec65e6B9C501C1ee34fb42f2575da4B517', //->betherchip test
        'contract' => '0x38f7cd43662d1cff4cc3c2c4b749f7cfed1d1db3',
        // 'master' => '0x8434121bbA14DD714fE08b04Ef9431eB2E641Eaf',
    ];

    // Fee Address - 0x97a1fd64c12a0ccc8cdbee6d2259cbaf266835e1

    public static $walletWithdrawals = [
        "address" => "0x95c3e65207d448b9638fc594bb398cbf72f5caa7",
        "privateKey" => "0dd5963d6258998426b6f5f094b149d3333c25686448c50eedfb3cc55c49c52e",
        "publicKey" => "7ec87c85a371b2a837bf157daea76df9832a51554c4a936f7597fde9267d2b37e32dd6c800a8ec8ecd9843bd6242f9ec186d913aa7f22f219822e63d51fd5b7e",
    ];

    public static $walletReceipt = [
        "address" => "0xDE40c7BdBc087c3F903dC3b8E194aF49D3F8E7CC",
    ];

    public function getBalanceToken($address){
        // dd($address);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/".$address."/".CryptoApisRepository::$configGeneral['contract']."/balance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisRepository::$configGeneral['api_key'],
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $balanceData = json_decode($response, true);
        // dd($balanceData);
        if($balanceData && isset($balanceData['payload']) && isset($balanceData['payload']['token'])){
            return [
                'status' => true,
                'balance' => $balanceData['payload']['token']
            ];
        }

        return ['status' => false, 'balance' => 0];

    }

    public function getBalanceEthereum($address){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/address/".$address."/balance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisRepository::$configGeneral['api_key'],
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $balanceData = json_decode($response, true);
        // dd($balanceData);
        if($balanceData && isset($balanceData['payload']) && isset($balanceData['payload']['balance'])){
            return [
                'status' => true,
                'balance' => $balanceData['payload']['balance']
            ];
        }

        return ['status' => false, 'balance' => 0];

    }

    public function sendTransaction($toAddress, $value, $fromAddress = null, $fromPrivate = null, $nonce = null){

        if($fromAddress){
          $fromData['address'] = $fromAddress;
          $fromData['privateKey'] = $fromPrivate;
        }else{
          $fromData['address'] = CryptoApisRepository::$mainWallet['address'];
          $fromData['privateKey'] = CryptoApisRepository::$mainWallet['privateKey'];
        }

        $curl = curl_init();

        if($nonce){
          $data = json_encode([
              "fromAddress" => $fromData['address'],
              "toAddress" => $toAddress,
              'gasPrice' => 131 * 1000000000,
              'gasLimit' => 21000,
              "value" => $value,
              "privateKey" => $fromData['privateKey'],
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              "fromAddress" => $fromData['address'],
              "toAddress" => $toAddress,
              'gasPrice' => 131 * 1000000000,
              'gasLimit' => 21000,
              "value" => $value,
              "privateKey" => $fromData['privateKey']
          ]);
        }

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/txs/new-pvtkey",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisRepository::$configGeneral['api_key'],
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $transactionData = json_decode($response, true);

        if($transactionData && isset($transactionData['payload']) && isset($transactionData['payload']['hex'])){
            return [
                'status' => true,
                'txid' => $transactionData['payload']['hex']
            ];
        }

        return ['status' => false];
    }

    // public function createForwardAddress(){

    //     $addressData = $this->generateNewAddress();
    //     if($addressData && $addressData['status']){
    //         $automation = $this->createAutomationForwarding($addressData['address'], $addressData['privateKey']);

    //         if($automation && $automation['status']){
    //             return [
    //                 'status' => true,
    //                 'automation_id' => $automation['data']['automation_id'],
    //                 'from_address' => $automation['data']['from_address'],
    //                 'to_address' => $automation['data']['to_address'],
    //                 'token' => $automation['data']['token'],
    //                 'minimum_transfer_amount' => $automation['data']['minimum_transfer_amount'],
    //                 'callback_url' => $automation['data']['callback_url'],
    //                 'privateKey' => $addressData['privateKey'],
    //                 'publicKey' => $addressData['publicKey'],
    //             ];
    //         }
    //     }

    //     return [
    //         'status' => false,
    //         'message' => 'error_forwarding',
    //     ];

    // }

    public function generateNewAddress(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/address",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisRepository::$configGeneral['api_key']
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $addressData = json_decode($response, true);
        // dd($addressData);
        if($addressData && isset($addressData['payload']) && isset($addressData['payload']['address'])){
            return [
                'status' => true,
                'address' => $addressData['payload']['address'],
                'privateKey' => $addressData['payload']['privateKey'],
                'publicKey' => $addressData['payload']['publicKey'],
            ];
        }

        return ['status' => false];

    }

    // public function createAutomationForwarding($fromAddress, $fromPrivKey){

    //     $curl = curl_init();

    //     $data = json_encode([
    //         "from_address" => $fromAddress,
    //         "to_address" => CryptoApisRepository::$configGeneral['master'],
    //         "token" => CryptoApisRepository::$configGeneral['contract'],
    //         "callback_url" => url('callback/token_forwarding'),
    //         "from_address_credentials" => [
    //             "private_key" => $fromPrivKey
    //         ],
    //         "minimum_transfer_amount" => 0.1,
    //     ]);

    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens-forwarding/automations",
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 0,
    //       CURLOPT_FOLLOWLOCATION => true,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "POST",
    //       CURLOPT_POSTFIELDS => $data,
    //       CURLOPT_HTTPHEADER => array(
    //         "Content-Type: application/json",
    //         "x-api-key: ".CryptoApisRepository::$configGeneral['api_key'],
    //       ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     $transactionData = json_decode($response, true);

    //     if($transactionData && isset($transactionData['payload']) && isset($transactionData['payload']['automation_id'])){
    //         return [
    //             'status' => true,
    //             'data' => $transactionData['payload']
    //         ];
    //     }

    //     return ['status' => false];
    // }

    public static function checkPayment($order_id, $forwarding_address, $returnJson = true){
        $order = Order::find($order_id);
        if (in_array($order->status_id, [1, 17])){
          $payment = Payment::where('order_id', $order->id)->where('processor_name', 'cryptoapis')->first();
          if($payment && $payment->status != 1){

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=".CryptoApisRepository::$configGeneral['contract']."&address=".$payment->address."&tag=latest&apikey=BKCIJW2HRWJG28VJSXD6RICJWKUIZMT6TD",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            $object = json_decode($response);

            curl_close($curl);

            if($object && $object->result > 0){

              $total_address = $object->result / 1000000000000000000;
              $order_total = ($payment->value_coin != 0) ? $payment->value_coin * 0.95 : $order_to_btc;

              if($total_address > $order_total){
                $payment->status = 1;
                if($payment->save()){
                  if(in_array($order->payment_method, ['ethplus', 'etherpay'])){
                    $order->updateHistoryStatus(6);
                    $order->executeWhenOrderIsPaid();
                  }
                }

                if($returnJson){
                  return response()->json(['status' => true], 200);
                }else{
                  return true;
                }
              }
            }
          }
        }

        if($returnJson){
          return response()->json(['status' => false], 505);
        }else{
          return false;
        }
    }

    public static function checkPaymentCron($order_id, $forwarding_address){
        $order = Order::find($order_id);
        if($order->status_id == 1){
          $payment = Payment::where('order_id', $order->id)->where('processor_name', 'cryptoapis')->first();
          if($payment && $payment->status != 1){
            $url = "https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=".CryptoApisRepository::$configGeneral['contract']."&address=".$payment->address."&tag=latest&apikey=BKCIJW2HRWJG28VJSXD6RICJWKUIZMT6TD";
            $get = file_get_contents($url);
            $object = json_decode($get);

            if(isset($object->result) && $object->result > 0){
              $total_address = $object->result / 10000000000;
            }else{
              $total_address = 0;
            }
            $order_total = ($payment->value_coin != 0) ? $payment->value_coin * 0.9 : $payment->value_coin * 0.91;

            if($total_address > $order_total){
              $payment->status = 1;
              if($payment->save()){
                if(in_array($order->payment_method, ['ethplus', 'etherpay'])){
                  $order->updateHistoryStatus(6);
                  $order->executeWhenOrderIsPaid();
                }
              }
              return true;
            }
          }
          return false;
        }
        return false;
    }

    public static function checkStatus($order_id)
    {
        $payment = Payment::where('order_id', $order_id)->where('processor_name', 'cryptoapis')->first();
        if($payment && $payment->status > 0){
          echo '<span class="text text-success" style="color: #333 !important"><i class="fa fa-check" style="color: #333 !important"></i> Payment was received! Your payment was processed.</span>';
        } else {
          echo '<span class="text text-info" style="color: #333 !important"><i class="fa fa-spin fa-spinner" style="color: #333 !important"></i> Awaiting payment...';
        }
    }



    public function sendToken($coin, $address, $amount){

        $master = [
            "address" => "0xc723d791e44fe761b0165b94a38db41354c1a0da",
            "privateKey" => "c3c01cfd68a8919d820b5a43b2dcbc25c369e7cc7432313c5926418bfb5630d8",
            "publicKey" => "b1043717f01c3177e93a9231bd002246181bdaf26c42bb3367d04199805c9c5398e649f39e24aa93aa286fedbd0db137c15d5ccf12ba025a28379109701d73ba"
        ];

        $gasPrice = $this->geGasPrice();

        if($gasPrice['status']){
            $gasPrice = $gasPrice['standard'];
        }else{
            return ['status' => false];
        }



        $data = json_encode([
            'fromAddress' => $master['address'],
            'toAddress' => $address,
            'contract' => CryptoApisRepository::$configGeneral['contract'],
            'privateKey' => $master['privateKey'],
            'gasPrice' => $gasPrice * 1000000000,
            'gasLimit' => 21000,
            'token' => $amount,
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/transfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApiRepository::$config['apiKey']
            ) ,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'txid' => $transaction['payload']['hex']];
        }

        return ['status' => false,'transaction' => $transaction];

    }

    public function geGasLimit($fromAddress, $toAddress, $tokenAmount){

        $token = CryptoApisRepository::$configGeneral['contract'];
        // dd(bcdiv($tokenAmount, 1, 2));
        $data = json_encode([
          'fromAddress' => $fromAddress,
          'toAddress' => $toAddress,
          'contract' => $token,
          'tokenAmount' => bcdiv($tokenAmount, 1, 4),
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/transfer/gas-limit",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);
        // dd($transaction);
        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['gasLimit'])){
            return [
              'status' => true,
              'gasLimit' => $transaction['payload']['gasLimit'],
            ];
        }

        return [
            'status' => false,
            'gasLimit' => $transaction,
        ];

    }

    public function geGasPrice(){

        $token = CryptoApisRepository::$configGeneral['contract'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/contracts/".$token."/gas-price",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['standard'])){
            return [
              'status' => true,
              'slow' => $transaction['payload']['slow'],
              'standard' => $transaction['payload']['standard'],
              'fast' => $transaction['payload']['fast'],
            ];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
            return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];

    }

    public function getAddressNonce($address){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/address/".$address."/nonce",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['nonce'])){
            return [
              'status' => true,
              'nonce' => $transaction['payload']['nonce'],
            ];
        }

        return ['status' => false];

    }


    public function sendTokenWithdrawal($from, $from_private, $amount, $toAddress, $nonce = null){

        // $from = CryptoApisRepository::$walletWithdrawals['address'];

        $gasLimit = $this->geGasLimit($from, $toAddress, $amount);
        // dd($gasLimit);
        if($gasLimit['status']){
            $gasLimit = $gasLimit['gasLimit'];
        }else{
            return ['status' => false];
        }

        $gasPrice = $this->geGasPrice();
            // dd($gasPrice);
        if($gasPrice['status']){
            $gasPrice = $gasPrice['standard'];
        }else{
            return ['status' => false];
        }
        // dd($gasPrice);
        if($nonce){
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $toAddress,
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => $from_private,
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
              'gasLimit' => (int) $gasLimit,
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $toAddress,
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => $from_private,
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
            //   'gasLimit' => (int) $gasLimit,
          ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/transfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);
        // dd($transaction);
        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'txid' => $transaction['payload']['hex']];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
            return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];
    }

    public function getTokenTransactionsByAddress($address){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/address/".$address."/transfers",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $transaction = json_decode($response, true);
    //   dd($transaction);
      if ($transaction && isset($transaction['payload'])){
          return ['status' => true, 'transactions' => $transaction['payload']];
      }

      return ['status' => false];

    }

    public function getAutomationsList(){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens-forwarding/automations",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/json",
          "X-API-Key: a9d6faa93b79ac74340d939d52ec034ffcee3c6d"
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      $transaction = json_decode($response, true);

      if ($transaction && isset($transaction['payload'])){
          return ['status' => true, 'transactions' => $transaction['payload']];
      }

      return ['status' => false];

    }

    public function sendTokenToDefault($amount, $toAddress, $nonce = null){

        $master = CryptoApisRepository::$walletWithdrawals['address'];
        // dd($toAddress);
        $gasLimit = $this->geGasLimit($master, $toAddress, $amount);
        // dd($gasLimit);
        if($gasLimit['status']){
            $gasLimit = $gasLimit['gasLimit'];
        }else{
            return ['status' => false];
        }

        $gasPrice = $this->geGasPrice();
            // dd($gasPrice);
        if($gasPrice['status']){
            $gasPrice = $gasPrice['standard'];
        }else{
            return ['status' => false];
        }
        // dd($gasPrice);
        if($nonce){
          $data = json_encode([
              'fromAddress' => CryptoApisRepository::$walletWithdrawals['address'],
              'toAddress' => $toAddress,
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => CryptoApisRepository::$walletWithdrawals['privateKey'],
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
              'gasLimit' => (int) $gasLimit,
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              'fromAddress' => CryptoApisRepository::$walletWithdrawals['address'],
              'toAddress' => $toAddress,
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => CryptoApisRepository::$walletWithdrawals['privateKey'],
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
            //   'gasLimit' => (int) $gasLimit,
          ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/transfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);
        // dd($transaction);
        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'txid' => $transaction['payload']['hex']];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
            return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];
    }

    public function sendTokenToStake($from, $from_private, $amount, $nonce = null){
        #master receive

        // $gasPrice = $this->geGasPrice();

        // dd($master);
        $gasLimit = $this->geGasLimit($from, CryptoApisRepository::$walletReceipt['address'], $amount);
        // dd($gasLimit);
        if($gasLimit['status']){
            $gasLimit = $gasLimit['gasLimit'];
        }else{
            return ['status' => false];
        }

        $gasPrice = $this->geGasPrice();
            // dd($gasPrice);
        if($gasPrice['status']){
            $gasPrice = $gasPrice['standard'];
        }else{
            return ['status' => false];
        }
        // dd($gasPrice);
        if($nonce){
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => CryptoApisRepository::$walletReceipt['address'],
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => $from_private,
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
              'gasLimit' => (int) $gasLimit,
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => CryptoApisRepository::$walletReceipt['address'],
              'contract' => CryptoApisRepository::$configGeneral['contract'],
              'privateKey' => $from_private,
              'token' => bcdiv($amount, 1, 2),
              'gasPrice' => (int) $gasPrice * 1000000000,
              'gasLimit' => (int) $gasLimit,
          ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/transfer",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "X-API-Key: " . CryptoApisRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);
        // dd($transaction);
        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'txid' => $transaction['payload']['hex']];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
            return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];
    }

    public function getTransactionByHash($hash){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/txs/hash/".$hash,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisRepository::$configGeneral['api_key']
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);
        // dd($result);
        if($result && isset($result['payload']) && $result['payload']){
            return [
                'status' => true,
                'confirmations' => $result['payload']['confirmations'],
                'token_transfers' => $result['payload']['token_transfers'],
            ];
        }

        return ['status' => false];

    }


}
