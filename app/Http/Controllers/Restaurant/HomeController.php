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
use App\Menu;

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

        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d'); //Week of the month

        $endOfWeek = Carbon::now()->endOfWeek()->subDays(2)->format('Y-m-d');

        $menus = Menu::whereBetween('menu_day', [$startOfWeek, $endOfWeek])->get();

        #Contagem de confirmados
        $orders_confirmed['monday'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->format('Y-m-d'))->count();
        $orders_confirmed['tuesday'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d'))->count();
        $orders_confirmed['wednesday'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d'))->count();
        $orders_confirmed['thursday'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d'))->count();
        $orders_confirmed['friday'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d'))->count();
        // dd($orders_confirmed);

        #Carrega os objetos de cada dia separado por categoria
        $categories = FoodCategory::get();
        foreach($categories as $category){
            $monday[$category->id]['name'] = $category->name;
            $monday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $tuesday[$category->id]['name'] = $category->name;
            $tuesday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $wednesday[$category->id]['name'] = $category->name;
            $wednesday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $thursday[$category->id]['name'] = $category->name;
            $thursday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $friday[$category->id]['name'] = $category->name;
            $friday[$category->id]['amount']= 0;
        }

        #Faz a contagem dos itens por categoria
        
        $foods_order_monday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->format('Y-m-d'))->get();
        $foods_order_tuesday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d'))->get();
        $foods_order_wednesday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d'))->get();
        $foods_order_thursday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d'))->get();
        $foods_order_friday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d'))->get();
        #Segunda
        foreach($foods_order_monday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $monday[$food->food_category_id]['amount']++;

            }
        }
         #Terça
        foreach($foods_order_tuesday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $tuesday[$food->food_category_id]['amount']++;

            }
        }
        #Quarta
        foreach($foods_order_wednesday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $wednesday[$food->food_category_id]['amount']++;

            }
        }
        #Quinta
        foreach($foods_order_thursday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $thursday[$food->food_category_id]['amount']++;

            }
        }
        #Sexta
        foreach($foods_order_friday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $friday[$food->food_category_id]['amount']++;

            }
        }
        

        
        // dd($tuesday);

         #Contagem de confirmados
        $one_days = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
        $orders['today'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->count();
        $orders['day-1'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(1))->count();
        $orders['day-2'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(2))->count();
        $orders['day+1'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->count();
        $orders['day+2'] = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(2))->count();

         #Carrega os objetos de cada dia separado por categoria
        $categories = FoodCategory::get();
        foreach($categories as $category){
            $all_category_before_yesterday[$category->id]['name'] = $category->name;
            $all_category_before_yesterday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $all_category_yesterday[$category->id]['name'] = $category->name;
            $all_category_yesterday[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $all_category[$category->id]['name'] = $category->name;
            $all_category[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $all_category_next_day[$category->id]['name'] = $category->name;
            $all_category_next_day[$category->id]['amount']= 0;
        }
        foreach($categories as $category){
            $all_category_next_two_day[$category->id]['name'] = $category->name;
            $all_category_next_two_day[$category->id]['amount']= 0;
        }

        #Faz a contagem dos itens por categoria
        #Today
        $foods_order_today = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->get();

        foreach($foods_order_today as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category[$food->food_category_id]['amount']++;

            }
        }

        #day+1
        $foods_order_tomorrow = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();

        foreach($foods_order_tomorrow as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_next_day[$food->food_category_id]['amount']++;

            }
        }

        #day+2
        $foods_order_after_tomorrow = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(2))->get();

        foreach($foods_order_after_tomorrow as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_next_two_day[$food->food_category_id]['amount']++;

            }
        }

        #yesterday
        $foods_order_yesterday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(1))->get();

        foreach($foods_order_yesterday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_yesterday[$food->food_category_id]['amount']++;

            }
        }

        #before yesterday
        $foods_order_before_yesterday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(2))->get();

        foreach($foods_order_before_yesterday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_before_yesterday[$food->food_category_id]['amount']++;

            }
        }



        $categories_all = FoodCategory::get();

        // $category = [];
        foreach($categories_all as $cat){
            $categoriesAll[$cat->name]['name'] = $cat->name;
            $categoriesAll[$cat->name]['itens'] = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', $cat->name)->select('foods.*', 'food_categories.name as category_name')->get();
        }

        $array = [];
        $confirmed_menus = Menu::pluck('menu_day');
       
        // dd($all_category_before_yesterday);
        // dd($all_category_next_two_day);

        // return view('restaurant.home', compact('orders', 'all_category', 'all_category_next_day', 'categoriesAll', 'all_category_next_two_day', 'all_category_yesterday', 'all_category_before_yesterday', 'confirmed_menus', 'categories_all'));
        return view('restaurant.home', compact('orders', 'all_category', 'all_category_next_day', 'categoriesAll', 'all_category_next_two_day', 'all_category_yesterday', 'all_category_before_yesterday', 'confirmed_menus', 'categories_all', 'orders_confirmed', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'));

    }


}
