<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Food;
use App\FoodCategory;
use App\FoodOrder;
use App\Http\Controllers\Controller;
use App\Justification;
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

        $startOfWeek = Carbon::now()->startOfWeek()->format('Y-m-d'); //Week of the month

        $endOfWeek = Carbon::now()->endOfWeek()->subDays(2)->format('Y-m-d');

        // $menus = Menu::whereBetween('menu_day', [$startOfWeek, $endOfWeek])->get();

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

        $categories_all = FoodCategory::get();

        foreach($categories_all as $cat){
            $categoriesAll[$cat->name]['name'] = $cat->name;
            $categoriesAll[$cat->name]['itens'] = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', $cat->name)->select('foods.*', 'food_categories.name as category_name')->get();
        }

        $array = [];
        $confirmed_menus = Menu::pluck('menu_day');

        #Justificativas
        
        $justifications = Justification::with([
            'user:id,name,email',
            'food_order' => function($q) {
                return $q->with(['menu:id'])->select('id', 'menu_id');
            }
        ])
            ->whereHas('food_order', function ($q) {
                return $q->whereHas('menu', function ($query) {
                    return $query->whereDate('menu_day', Carbon::today());
                });
            })
            ->get();

        #Arms
        $arms = User::join('role_user', 'users.id', '=', 'role_user.user_id')
        ->where('role_user.role_id', 3)
        ->select([
            'users.id',
            'users.name',
        ])->get();
        // dd($arms);
        
        return view('superadmin.home', compact( 'confirmed_menus','categoriesAll', 'categories_all','orders_confirmed', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'justifications', 'arms'));
    }

    public function dataDetailMenu(Request $request){
        $foods = Food::get();
        
        $day = $request->day;        

        if($day == 'monday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }

             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->format('Y-m-d'))->get();
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'tuesday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }

             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d'))->get();

             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'wednesday'){

            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
            
            $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d'))->get();

            foreach($foods_order as $order){
                $itens = json_decode($order->itens_selected);
                foreach($itens as $item){
                    $food = Food::find($item);
                    $all_foods[$food->id]['amount']++;

                }
            }
            return response()->json( [$all_foods] );
        }elseif($day == 'thursday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }

             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(3)->format('Y-m-d'))->get();
            
             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }elseif($day == 'friday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }
          
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->whereDate('menus.menu_day', Carbon::now()->startOfWeek()->addDays(4)->format('Y-m-d'))->get();

             foreach($foods_order as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount']++;

                 }
             }
             return response()->json( [$all_foods] );
        }
        return response()->json("Error");

    }

    public function getJustifications(Request $request){
        $date = $request->date;
        // $justifications = Justification::join('users', 'users.id', '=', 'justifications.user_id')
        //                     ->join('menus', 'menus.id', '=', 'justifications.menu_id')
        //                     ->whereDate('menus.menu_day', $date)
        //                     ->select('users.name', 'users.email', 'justifications.*')
        //                     ->get();
        // $teste = 'teste';
        // return response()->json( [$teste] );
        $justifications = Justification::with([
            'user:id,name,email',
            'food_order' => function($q) use ($date) {
                return $q->with(['menu:id'])->select('id', 'menu_id');
            }
        ])
            ->whereHas('food_order', function ($q) use ($date) {
                return $q->whereHas('menu', function ($query) use ($date) {
                    return $query->whereDate('menu_day', $date);
                });
            })
            ->get();

        return response()->json( [$justifications] );
    }

    public function teste(){
        return view('superadmin.teste');
    }

    public function getReportData(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $dates = [];
        $amount = [];

        // $menus = FoodOrder::with([
        //     'menu:id,menu_day'
        // ])
        // ->get();

        $menus = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')
                            ->whereBetween('menu_day', [$from_date, $to_date])
                            ->select('menus.menu_day')
                            ->get();

        foreach($menus as $menu){
            if(!in_array($menu->menu_day, $dates, true)){
                array_push($dates, $menu->menu_day);
            }
        }

        foreach($dates as $date){
            $orders_day_amount = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')
            ->whereDate('menus.menu_day', $date)
            ->select('menus.menu_day')
            ->count();
            if($orders_day_amount > 0){
                array_push($amount, $orders_day_amount);
            }
            $orders_day_amount = 0;
            
        }
        
        return response()->json( [$dates, $amount] );
    }

}
