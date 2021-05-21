<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Food;
use App\FoodCategory;
use App\FoodOrder;
use App\Http\Controllers\Controller;
use App\Menu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $this->middleware('needsRole:superadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $title = 'Super Admin';

        // $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d'); //Week of the month

        // $endOfWeek = Carbon::now()->endOfWeek()->subDays(2)->format('Y-m-d');

        //  //Week of the month
        // $menus = Menu::whereBetween('menu_day', [$startOfWeek, $endOfWeek])->get();
        // // dd($teste);

        // $categories = FoodCategory::get();
        // foreach($categories as $category){
        //     $all_category_before_yesterday[$category->id]['name'] = $category->name;
        //     $all_category_before_yesterday[$category->id]['amount']= 0;
        // }
        // foreach($categories as $category){
        //     $all_category_yesterday[$category->id]['name'] = $category->name;
        //     $all_category_yesterday[$category->id]['amount']= 0;
        // }
        // foreach($categories as $category){
        //     $all_category[$category->id]['name'] = $category->name;
        //     $all_category[$category->id]['amount']= 0;
        // }
        // foreach($categories as $category){
        //     $all_category_next_day[$category->id]['name'] = $category->name;
        //     $all_category_next_day[$category->id]['amount']= 0;
        // }
        // foreach($categories as $category){
        //     $all_category_next_two_day[$category->id]['name'] = $category->name;
        //     $all_category_next_two_day[$category->id]['amount']= 0;
        // }


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
        $foods_order_today = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today())->get();

        // $teste = [];
        foreach($foods_order_today as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category[$food->food_category_id]['amount']++;

            }
        }

        #day+1
        $foods_order_tomorrow = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();

        foreach($foods_order_tomorrow as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_next_day[$food->food_category_id]['amount']++;

            }
        }

        #day+2
        $foods_order_after_tomorrow = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->addDays(2))->get();

        foreach($foods_order_after_tomorrow as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_next_two_day[$food->food_category_id]['amount']++;

            }
        }

        #yesterday
        $foods_order_yesterday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->subDays(1))->get();

        foreach($foods_order_yesterday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_yesterday[$food->food_category_id]['amount']++;

            }
        }

        #before yesterday
        $foods_order_before_yesterday = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->subDays(2))->get();

        foreach($foods_order_before_yesterday as $order){
            $itens = json_decode($order->itens_selected);
            foreach($itens as $item){
                $food = Food::find($item);
                $all_category_before_yesterday[$food->food_category_id]['amount']++;

            }
        }


        #categorias para separar no modal
        $categories_all = FoodCategory::get();

        foreach($categories_all as $cat){
            $categoriesAll[$cat->name]['name'] = $cat->name;
            $categoriesAll[$cat->name]['itens'] = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', $cat->name)->select('foods.*', 'food_categories.name as category_name')->get();
        }

        $array = [];
        $confirmed_menus = Menu::pluck('menu_day');

        return view('superadmin.home', compact('orders', 'all_category', 'all_category_next_day', 'categoriesAll', 'all_category_next_two_day', 'all_category_yesterday', 'all_category_before_yesterday', 'confirmed_menus', 'categories_all'));
    }

    public function dataDetailMenu(Request $request){
        $foods = Food::get();
        
        $day = $request->day;        

        if($day == 'after_tomorrow'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->addDays(2))->get();
            // dd($foods_order);
             $teste = [];
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     // array_push($teste, $food->name);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'tomorrow'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();
            // dd($foods_order);
             $teste = [];
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     // array_push($teste, $food->name);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'today'){

            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->format('d/m/Y');
             #Today
            $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today())->get();

            $teste = [];
            foreach($foods_order as $order){
                $itens = json_decode($order->itens_selected);
                foreach($itens as $item){
                    $food = Food::find($item);
                    $all_foods[$food->id]['amount']++;

                }
            }
            return response()->json( [$all_foods] );
        }elseif($day == 'yesterday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->subDays(1))->get();

             $teste = [];
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'before_yesterday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');

             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::today()->subDays(2))->get();

             $teste = [];
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     // array_push($teste, $food->name);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }
        return response()->json("Error");
    }

}
