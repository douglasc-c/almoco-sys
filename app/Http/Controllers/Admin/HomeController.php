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
        $title = 'Admin';
    	return view('admin.index', compact('title'));
    }

}
