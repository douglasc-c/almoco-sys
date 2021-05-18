<?php

namespace App\Http\Controllers\Restaurant;

use App\FoodCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Artesaos\Defender\Facades\Defender;
use App\Mail\UserRegister;
use App\User;
use App\Food;
use App\FoodOrder;
use App\Menu;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function index(){

        $title = 'Cardapios';
        $categories_all = FoodCategory::get();

        // $category = [];
        foreach($categories_all as $cat){
            $category[$cat->name]['name'] = $cat->name;
            $category[$cat->name]['itens'] = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', $cat->name)->select('foods.*', 'food_categories.name as category_name')->get();
        }
        // dd($category);
        $garnishs = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', 'Acompanhamentos')->select('foods.*', 'food_categories.name as category_name')->get();
        $meets = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', 'Carnes')->select('foods.*', 'food_categories.name as category_name')->get();
        $vegetables = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->where('food_categories.name', 'Verduras')->select('foods.*', 'food_categories.name as category_name')->get();
        
        // return view('restaurant.menus.index', compact('title', 'garnishs', 'meets', 'vegetables'));
        return view('restaurant.menus.index', compact('title', 'category'));
    }

    public function dataMenu(){

        $menus = Menu::select([
            'menus.id',
            'menus.menu_day',
            'menus.foods_id',
            'menus.updated_at',
            'menus.created_at'])
            ->orderBy('menus.created_at', 'DESC');

        return Datatables::of($menus)
        ->editColumn('foods_id', function($menu) {
            $foods = json_decode($menu->foods_id);
            $foods_name = [];
            foreach($foods as $food){
                $food_find = Food::find($food);
                $food_name = array_push($foods_name, $food_find->name);
            }
            return $foods_name;
        })
        ->escapeColumns('status')
        ->make(true);
    }

    public function createMenu(Request $request){
        // dd($request);
        $rules = array(
            'day_value' => ['required'],
            'month_value' => ['required'],
        );
        $date = new Carbon();   
        $year = $date->format('Y');

        $month_value = str_pad($request->month_value, 2, 0, STR_PAD_LEFT);

        $menu_day = $year.'-'.$month_value.'-'.$request->day_value;
        // dd($menu_day);
        if ($request->validate($rules)){

            $foods_ids = [];
            foreach(Food::get() as $food){
                if(isset($request->checkbox[$food->name]) && $request->checkbox[$food->name])array_push($foods_ids, $food->id);
            }

            if(sizeof($foods_ids) == 0)   return redirect()->back()->with('danger', 'Não foi possível criar o menu');
            // dd($menu_day);
            $menu_find = Menu::where('menu_day', 'LIKE', '%'.$menu_day.'%')->first();

            if(!$menu_find){
                $menu = Menu::create([
                    'menu_day' => $menu_day,
                    'foods_id' => json_encode($foods_ids)
                ]);

                return redirect()->back()->with('success', 'Menu criado com sucesso!');
            }else {
                return redirect()->back()->with('danger', 'Cardapio já cadastrado para essa data!');
            }

        }
        return redirect()->back()->with('danger', 'Erro ao criar menu');
    }

    public function show($day){

        $foods = Food::get();
        foreach($foods as $food){
            $all_foods[$food->id]['name'] = $food->name;
            $all_foods[$food->id]['amount']= 0;
        }
        foreach($foods as $food){
            $all_foods_tomorrow[$food->id]['name'] = $food->name;
            $all_foods_tomorrow[$food->id]['amount']= 0;
        }

        if($day == 'tomorrow'){
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();
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
            //  dd($all_foods);
        }elseif($day == 'today'){
            $date = Carbon::today()->format('d/m/Y');
             #Today
            $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->get();

            $teste = [];
            foreach($foods_order as $order){
                $itens = json_decode($order->itens_selected);
                foreach($itens as $item){
                    $food = Food::find($item);
                    // array_push($teste, $food->name);
                    $all_foods[$food->id]['amount']++;

                }
            }
            // dd($all_foods);
        }
        $title = 'Cardapido dia: '.$date;

        return view('restaurant.menus.show', compact('title', 'all_foods', 'date'));
    }

    public function dataDetailMenu(Request $request){
        $foods = Food::get();
        
        $day = $request->day;        

        if($day == 'after_tomorrow'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(2))->get();
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
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->addDays(1))->get();
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
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->format('d/m/Y');
             #Today
            $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today())->get();

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
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(1))->get();
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
        }elseif($day == 'before_yesterday'){
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['amount']= 0;
            }
            $date = Carbon::today()->addDays(1)->format('d/m/Y');
             #Today
             $foods_order = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')->where('status', 1)->whereDate('menus.menu_day', Carbon::today()->subDays(2))->get();
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
        }
        return response()->json("Error");
    }

}
