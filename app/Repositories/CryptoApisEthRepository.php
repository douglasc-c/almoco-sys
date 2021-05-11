<?php

namespace App\Repositories;

use App\Payment;
use App\Order;
use DB;

class CryptoApisEthRepository
{
    public static $configGeneral = [
        'api_key' => 'a9d6faa93b79ac74340d939d52ec034ffcee3c6d',
        'contract' => '0x601938988f0fdd937373ea185c33751462b1d194'
    ];

    public function getBalanceToken($address){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/tokens/".$address."/".CryptoApisEthRepository::$configGeneral['contract']."/balance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "x-api-key: ".CryptoApisEthRepository::$configGeneral['api_key'],
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $balanceData = json_decode($response, true);

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
            "x-api-key: ".CryptoApisEthRepository::$configGeneral['api_key'],
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $balanceData = json_decode($response, true);

        if($balanceData && isset($balanceData['payload']) && isset($balanceData['payload']['balance'])){
            return [
                'status' => true,
                'balance' => bcdiv($balanceData['payload']['balance'], 1, 4)
            ];
        }

        return ['status' => false, 'balance' => 0];

    }

    public function sendTransaction($toAddress, $value, $fromAddress = null, $fromPrivate = null, $nonce = null){

        if($fromAddress){
          $fromData['address'] = $fromAddress;
          $fromData['privateKey'] = $fromPrivate;
        }else{
          $fromData['address'] = CryptoApisEthRepository::$mainWallet['address'];
          $fromData['privateKey'] = CryptoApisEthRepository::$mainWallet['privateKey'];
        }

        $curl = curl_init();

        if($nonce){
          $data = json_encode([
              "fromAddress" => $fromData['address'],
              "toAddress" => $toAddress,
              'gasPrice' => 106 * 1000000000,
              'gasLimit' => 36383,
              "value" => $value,
              "privateKey" => $fromData['privateKey'],
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              "fromAddress" => $fromData['address'],
              "toAddress" => $toAddress,
              'gasPrice' => 106 * 1000000000,
              'gasLimit' => 36383,
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
            "x-api-key: ".CryptoApisEthRepository::$configGeneral['api_key'],
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

    public function createForwardAddress(){

        $addressData = $this->generateNewAddress();
        if($addressData && $addressData['status']){
            $automation = $this->createAutomationForwarding($addressData['address'], $addressData['privateKey']);
            if($automation && $automation['status']){
                return [
                    'status' => true,
                    'automation_id' => $automation['data']['automation_id'],
                    'from_address' => $automation['data']['from_address'],
                    'to_address' => $automation['data']['to_address'],
                    'token' => $automation['data']['token'],
                    'minimum_transfer_amount' => $automation['data']['minimum_transfer_amount'],
                    'callback_url' => $automation['data']['callback_url'],
                    'privateKey' => $addressData['privateKey'],
                ];
            }
        }

        return ['status' => false];

    }

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
            "x-api-key: ".CryptoApisEthRepository::$configGeneral['api_key']
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $addressData = json_decode($response, true);

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
    //         "to_address" =>'0x75bAA1Dc05ccFF380602E871DA158741557EA837',
    //         "token" => CryptoApisEthRepository::$configGeneral['contract'],
    //         "callback_url" => url('callback/token_forwarding'),
    //         "from_address_credentials" => [
    //             "private_key" => $fromPrivKey
    //         ],
    //         "minimum_transfer_amount" => 1,
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
    //         "x-api-key: ".CryptoApisEthRepository::$configGeneral['api_key'],
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

    public function sendToken($coin, $address, $amount){

        $master = [
            "address" => "0xc723d791e44fe761b0165b94a38db41354c1a0da",
            "privateKey" => "c3c01cfd68a8919d820b5a43b2dcbc25c369e7cc7432313c5926418bfb5630d8",
            "publicKey" => "b1043717f01c3177e93a9231bd002246181bdaf26c42bb3367d04199805c9c5398e649f39e24aa93aa286fedbd0db137c15d5ccf12ba025a28379109701d73ba"
        ];

        $gasPrice = $this->geGasPrice();

        if($gasPrice['status']){
            $gasPrice = $gasPrice['slow'];
        }else{
            return ['status' => false];
        }



        $data = json_encode([
            'fromAddress' => $master['address'],
            'toAddress' => $address,
            'contract' => CryptoApisEthRepository::$configGeneral['contract'],
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

    public function sendTokens($amount, $to, $from, $fromPriv, $nonce = null){

        $gasLimit = $this->geGasLimit($from, $to, $amount);

        if($gasLimit['status']){
            $gasLimit = $gasLimit['gasLimit'];
        }else{
            return $gasLimit;
        }

        $gasPrice = $this->geGasPrice();

        if($gasPrice['status']){
            $gasPrice = $gasPrice['slow'];
        }else{
            return $gasPrice;
        }

        $token = CryptoApisEthRepository::$configGeneral['contract'];

        if($nonce){
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $to,
              'contract' => CryptoApisEthRepository::$configGeneral['contract'],
              'privateKey' => $fromPriv,
              'token' => $amount,
              'gasPrice' => (int) $gasPrice * 1000000000,
              'gasLimit' => (int) $gasLimit,
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $to,
              'contract' => CryptoApisEthRepository::$configGeneral['contract'],
              'privateKey' => $fromPriv,
              'token' => $amount,
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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'payload' => $transaction['payload'], 'txid' => $transaction['payload']['hex']];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
          return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];
    }

    public function sendEther($amount, $to, $from, $fromPriv, $nonce = null){

        $gasLimit = $this->geGasLimitEther($from, $to, $amount);

        if($gasLimit['status']){
            $gasLimit = $gasLimit['gasLimit'];
        }else{
            return ['status' => false];
        }

        $gasPrice = $this->geGasPriceEther();

        if($gasPrice['status']){
            $gasPrice = $gasPrice['slow'];
        }else{
            return ['status' => false];
        }

        $token = CryptoApisEthRepository::$configGeneral['contract'];

        if($nonce){
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $to,
              'privateKey' => $fromPriv,
              'value' => $amount,
              'gasPrice' => $gasPrice * 1000000000,
              'gasLimit' => $gasLimit,
              'nonce' => $nonce,
          ]);
        }else{
          $data = json_encode([
              'fromAddress' => $from,
              'toAddress' => $to,
              'privateKey' => $fromPriv,
              'value' => $amount,
              'gasPrice' => $gasPrice * 1000000000,
              'gasLimit' => $gasLimit,
          ]);
        }

        $curl = curl_init();

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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['hex'])){
            return ['status' => true, 'payload' => $transaction['payload'], 'txid' => $transaction['payload']['hex']];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
          return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];

    }

    public function geGasLimitEther($fromAddress, $toAddress, $value){

        $data = json_encode([
          'fromAddress' => $fromAddress,
          'toAddress' => $toAddress,
          'value' => bcdiv($value, 1, 4),
        ]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/txs/gas",
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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['gasLimit'])){
            return [
              'status' => true,
              'gasLimit' => $transaction['payload']['gasLimit'],
            ];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
          return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];

    }

    public function geGasPriceEther(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/txs/fee",
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
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['slow'])){
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

    public function geGasLimit($fromAddress, $toAddress, $tokenAmount){

        $token = CryptoApisEthRepository::$configGeneral['contract'];

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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['gasLimit'])){
            return [
              'status' => true,
              'gasLimit' => $transaction['payload']['gasLimit'],
            ];
        }

        if($transaction && isset($transaction['meta']) && isset($transaction['meta']['error'])){
          return ['status' => false, 'message' => $transaction['meta']['error']['message'], 'code' => $transaction['meta']['error']['code']];
        }

        return ['status' => false, 'message' => 'Have an error in your request'];

    }

    public function geGasPrice(){

        $token = CryptoApisEthRepository::$configGeneral['contract'];

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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
            ) ,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $transaction = json_decode($response, true);

        if ($transaction && isset($transaction['payload']) && isset($transaction['payload']['slow'])){
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
                "X-API-Key: " . CryptoApisEthRepository::$configGeneral['api_key']
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

      if ($transaction && isset($transaction['payload'])){
          return ['status' => true, 'transactions' => $transaction['payload']];
      }

      return ['status' => false];

    }

    public function getTransactionsByAddress($address){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.cryptoapis.io/v1/bc/eth/mainnet/address/".$address."/transactions",
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

      if ($transaction && isset($transaction['payload'])){
          return ['status' => true, 'transactions' => $transaction['payload']];
      }

      return ['status' => false];

    }

}
