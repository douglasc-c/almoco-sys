<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Credit;
use App\FoodOrder;
use Carbon\Carbon;
use Cache;
use Validator;
use App\FoodCategory;
use App\Food;

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
        $this->middleware('needsRole:restaurantuser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dashboard Restaurante';

        $user = Auth::user();

        $one_days = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
        $orders['today'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->count();
        $orders['day-1'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(1))->count();
        $orders['day-2'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(2))->count();
        $orders['day+1'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->count();
        $orders['day+2'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(2))->count();
        // dd(Carbon::today());



        $categories = FoodCategory::get();
        foreach($categories as $category){
            $all_category[$category->id]['name'] = $category->name;
            $all_category[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $all_category_next_day[$category->id]['name'] = $category->name;
            $all_category_next_day[$category->id]['amount']= 0;
        }

        #Today
        $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->get();

        $teste = [];
        foreach($foods_order as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                // array_push($teste, $food->name);
                $all_category[$food->food_category_id]['amount']++;

            }
        }

        #next day
        $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();

        $teste = [];
        foreach($foods_order as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                // array_push($teste, $food->name);
                $all_category_next_day[$food->food_category_id]['amount']++;

            }
        }

        $categories_all = FoodCategory::get();

        // $category = [];
        foreach($categories_all as $cat){
            $categoriesAll[$cat->name]['name'] = $cat->name;
            $categoriesAll[$cat->name]['itens'] = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', $cat->name)->select('foods.*', 'food_categories.name as category_name')->get();
        }
        // dd($categoriesAll);

        return view('restaurant.home', compact('orders', 'all_category', 'all_category_next_day', 'categoriesAll'));

    }


}
