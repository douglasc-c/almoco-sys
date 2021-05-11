<?php

namespace App\Http\Controllers\Dashboard;

use App\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\FoodOrder;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('needsRole:user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dashboard';

        #Get Menus
        $menus = Menu::getMenu();
        // dd($menus);
        return view('dashboard.home', compact('menus'));


    }

    public function confirmMenu(Request $request){
        $foods_ids = [];
        foreach(Food::get() as $food){
            if(isset($request->checkbox[$food->id]) && $request->checkbox[$food->id])array_push($foods_ids, $food->id);
        }
        // dd($foods_ids);
        $user = User::find(Auth::id());
        $confirm = FoodOrder::create([
            'menu_day' => $request->date_menu,
            'itens_selected' => json_encode($foods_ids),
            'status' => 1,
            'user_id' => $user->id,
            'menu_id' => $request->menu_id,

        ]);

        return redirect()->back()->with('success', 'Menu confirmado com sucesso!');
    }
}
