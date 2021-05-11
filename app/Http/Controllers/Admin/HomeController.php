<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Credit;
use Cache;
use App\Repositories\CryptoApisRepository;
use App\Wallet;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('needsRole:admin');
    }

    public function index(){

        if(Auth::user()->hasRole('onlyValidation'))return redirect()->to('admin/users-validations/0');
    	$title = 'Home';
        $users = User::orderBy('created_at', 'DESC')->limit(10)->get();
        $transactionsDefault = Credit::where('type_id', 1)->orderBy('created_at', 'DESC')->limit(10)->get();
        $transactionsStake = Credit::where('type_id', 2)->orderBy('created_at', 'DESC')->limit(10)->get();

        // Wallet Fee
        $walletFee['address'] = '0xDE40c7BdBc087c3F903dC3b8E194aF49D3F8E7CC';
        $criptos = New CryptoApisRepository;
        $walletFee['balance'] = Cache::remember('balancesFee', 5, function() use($criptos, $walletFee) {
            $walletFee['balance'] = $criptos->getBalanceToken($walletFee['address'])['balance'];
            return $walletFee['balance'];
        });
        $walletFee['need_recharge'] = ($walletFee['balance'] < 0.01) ? true : false;
        // . wallet fee

        // Wallet Withdrawal
        $walletWithdrawal['address'] = CryptoApisRepository::$walletWithdrawals['address'];
        $criptos = New CryptoApisRepository;
        $walletWithdrawal['balance'] = Cache::remember('balancesPaymentsEth', 5, function() use($criptos, $walletWithdrawal) {
            $walletWithdrawal['balance'] = $criptos->getBalanceEthereum($walletWithdrawal['address'])['balance'];
            return $walletWithdrawal['balance'];
        });
        $walletWithdrawal['balance_nva'] = Cache::remember('balancesPaymentsNeeva', 5, function() use($criptos, $walletWithdrawal) {
            $walletWithdrawal['balance_nva'] = $criptos->getBalanceToken($walletWithdrawal['address'])['balance'];
            return $walletWithdrawal['balance_nva'];
        });
        // . wallet withdrawal

    	return view('admin.index', compact('title', 'users', 'transactionsDefault', 'transactionsStake', 'walletFee', 'walletWithdrawal'));
    }

    public function transferToWallet(){

        $criptos = New CryptoApisRepository;
        $send = $criptos->sendMasterTowallet();

        if($send && isset($send['status']) && $send['status']){

            return redirect()->back()->with('success', 'Transaction send with success (wait the confirmations). Hash generated: '.$send['txid']);

        }else{
            return redirect()->back()->with('danger', 'Error: '. $send['message']);
        }
    }

    public function showWallet(){
        $title = 'Wallets';
        // dd('teste');
        $wallets = Wallet::where('status', 1)->get();

        return view('admin/wallets.index', compact('title', 'wallets'));
    }
}
