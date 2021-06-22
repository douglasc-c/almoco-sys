<?php

namespace App\Http\Controllers\Mobile;

use App\Food;
use App\Menu;
use App\FoodOrder;
use Carbon\Carbon;
use App\Justification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function listMenuWeek(Request $request)
    {
        $user = auth('api')->user();

        if (now()->dayOfWeek == Carbon::SATURDAY || now()->dayOfWeek == Carbon::SUNDAY) {
            $startOfWeek = now()->addWeek()->startOfWeek()->format('Y-m-d');

            $endOfWeek = now()->addWeek()->endOfWeek()->subDays(2)->format('Y-m-d');
        } else {
            $startOfWeek = now()->startOfWeek()->format('Y-m-d');

            $endOfWeek = now()->endOfWeek()->subDays(2)->format('Y-m-d');
        }

        $week = Menu::whereBetween('menu_day', [$startOfWeek, $endOfWeek])->orderBy('menu_day', 'ASC')->get();

        foreach ($week as $item) {
            $foods = Food::whereIn('id', json_decode($item->foods_id))->get();
            $food_order = FoodOrder::with('status')->where('menu_id', $item->id)->where('user_id', $user->id)->first();

            $item->foods = $foods;
            $item->food_order = $food_order;
        }

        return response()->json(['week' => $week]);
    }

    public function createOrder(Request $request)
    {
        $user = auth('api')->user();

        $menu = Menu::find($request->menu_id);

        if (isset($menu)) {
            if (isset($request->fee) && $request->fee == true) {
                //Aplicar taxa na Compralo do cidadão
            }
            $food_order = FoodOrder::create([
                'itens_selected' => json_encode($request->itens),
                'status_id' => 2,
                'user_id' => $user->id,
                'menu_id' => $request->menu_id,
            ]);

            return response()->json(['food_order' => $food_order]);
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar o menu"], 401);
        }
    }

    public function confirmLunch(Request $request)
    {
        $user = auth('api')->user();
        $menu = Menu::whereDate('menu_day', now()->format('Y-m-d'))->first();
        $today = today()->addHours(15);
        
        if (now('America/Sao_Paulo')->isAfter($today)) {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Horário de almoço acabou"], 401);
        }

        if (isset($menu)) {
            $food_order = FoodOrder::where('status_id', 2)
                                    ->where('user_id', $user->id)
                                    ->where('menu_id', $menu->id)
                                    ->first();
            if (isset($food_order)) {
                if (env('QRCODE_KEY') === $request->code) {
                    $food_order->update([
                        'status_id' => 3
                    ]);

                    return response()->json(["food_order" => $food_order]);
                } else {
                    return response()->json(["error" => "Ops, algo de errado", "message" => "QrCode inválido"], 401);
                }
            } else {
                return response()->json(["error" => "Ops, algo de errado", "message" => "Nenhuma solicitação encontrada para esse usuário"], 401);
            }
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Nenhum cardápio encontrado na data de hoje"], 401);
        }
    }

    public function updateOrder(Request $request)
    {
        $user = auth('api')->user();

        $menu = Menu::find($request->menu_id);

        if (isset($menu)) {
            $food_order = FoodOrder::where('menu_id', $menu->id)->where('user_id', $user->id)->first();

            if (isset($food_order)) {
                $food_order->update([
                    'itens_selected' => json_encode($request->itens),
                    'status_id' => 2,
                    'user_id' => $user->id,
                    'menu_id' => $request->menu_id,
                ]);

                return response()->json(['food_order' => $food_order]);
            } else {
                return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar a ordem"], 401);
            }
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar o menu"], 401);
        }
    }

    public function deleteOrder(Request $request)
    {
        $user = auth('api')->user();

        $menu = Menu::find($request->menu_id);

        if (isset($menu)) {
            $food_order = FoodOrder::where('menu_id', $menu->id)->where('user_id', $user->id)->first();

            if (isset($food_order)) {
                $food_order->delete();

                return response()->json(['message' => 'Ordem cancelada']);
            } else {
                return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar a ordem"], 401);
            }
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar o menu"], 401);
        }
    }

    public function listHistoric(Request $request)
    {
        $user = auth('api')->user();

        $menus = Menu::orderBy('menu_day', 'DESC')->get();

        foreach ($menus as $item) {
            $food_order = FoodOrder::with(['status', 'justification' => function ($q) {
                $q->with('status');
            }])
                ->where('menu_id', $item->id)
                ->where('user_id', $user->id)
                ->first();



            $item->food_order = $food_order;
        }

        return response()->json(['items' => $menus]);
    }

    public function createJustification(Request $request)
    {
        $user = auth('api')->user();

        $food_order = FoodOrder::where('id', $request->food_order_id)->where('user_id', $user->id)->first();


        if (isset($food_order)) {
            $file_url1 = null;
            $file_url2 = null;

            $imgs_link = [];

            if ($request->file('img1') !== null) {
                $file1 = $request->file('img1');
                $filename1 = strtoupper(bin2hex(random_bytes(5))).'.png';
                $file_path1 = "/justification/$food_order->id/$user->id/$filename1";
                $storage1 = Storage::disk('spaces')->put($file_path1, $file1, 'public');
                $file_url1 = 'https://lunch.nyc3.digitaloceanspaces.com/'.$storage1;
            }
            if ($request->file('img2') !== null) {
                $file2 = $request->file('img2');
                $filename2 = strtoupper(bin2hex(random_bytes(5))).'.png';
                $file_path2 = "/justification/$food_order->id/$user->id/$filename2";
                $storage2 = Storage::disk('spaces')->put($file_path2, $file2, 'public');
                $file_url2 = 'https://lunch.nyc3.digitaloceanspaces.com/'.$storage2;
            }

            if ($file_url1 !== null) {
                array_push($imgs_link, $file_url1);
            }
            if ($file_url2 !== null) {
                array_push($imgs_link, $file_url2);
            }

            // dd(json_encode($imgs_link));

            $justification = Justification::create([
                'status_id' => 6,
                'user_id' => $user->id,
                'arm_id' => $user->arm_id,
                'food_orders_id' => $food_order->id,
                'description' => $request->description,
                'justification_img_link' => json_encode($imgs_link),
            ]);

            return response()->json(['justification' => $justification]);
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Não foi possível encontrar a ordem"], 401);
        }
    }

    public function listTeam(Request $request)
    {
        $user = auth('api')->user();

        $menus = Menu::orderBy('menu_day', 'DESC')->get();

        foreach ($menus as $item) {
            $food_order = FoodOrder::with(['status', 'user', 'justification'])
                ->whereHas('user', function ($q) use ($user) {
                    return $q->where('arm_id', $user->id);
                })
                ->where('menu_id', $item->id)
                ->get();

            $item->food_order = $food_order;
        }

        return response()->json(['items' => $menus]);
    }

    public function acceptJustification(Request $request)
    {
        $user = auth('api')->user();

        foreach ($request->itens as $item) {
            $food_order = FoodOrder::find($item);

            if (isset($food_order)) {
                $food_order->justification->update([
                    'status_id' => 8,
                    'arm_id' => $user->id
                ]);
            }
        }

        return response()->json(['message' => 'Ordens atualizadas com sucesso']);
    }
    
    public function denyJustification(Request $request)
    {
        $user = auth('api')->user();

        foreach ($request->itens as $item) {
            $food_order = FoodOrder::find($item);

            if (isset($food_order)) {
                $food_order->justification->update([
                    'status_id' => 7,
                    'arm_id' => $user->id
                ]);
            }
        }

        return response()->json(['message' => 'Ordens atualizadas com sucesso']);
    }

    public function listCountFood(Request $request)
    {
        $menus = Menu::orderBy('menu_day', 'DESC')->get();
        $foods = Food::get();
        
        foreach ($menus as $menu) {
            foreach($foods as $food){
                $all_foods[$food->id]['name'] = $food->name;
                $all_foods[$food->id]['category_id'] = $food->food_category_id;
                $all_foods[$food->id]['amount']= 0;
            }

            $food_orders = FoodOrder::where('menu_id', $menu->id)->where('status_id', 2)->get();
            $menu->count_orders = count($food_orders);
            
            foreach($food_orders as $order){
                 $itens = json_decode($order->itens_selected);
                 foreach($itens as $item){
                     $food = Food::find($item);
                     $all_foods[$food->id]['amount'] += 1;
                 }
            }
            
            $currentFoods = collect([]);

            foreach ($all_foods as $item) {
                if ($item["amount"] > 0) {
                    $currentFoods->add($item);
                }
            }

            $menu->all_foods = $currentFoods;
        }

        return response()->json(['items' => $menus]);
    }
}
