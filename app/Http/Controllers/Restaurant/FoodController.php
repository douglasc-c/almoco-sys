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

class FoodController extends Controller
{
    public function foodIndex(){

        $title = 'Catgorias de Alimentos';
        $categories = FoodCategory::get();
        // $categories = FoodCategory::all();
        // dd($categories);
        // $total['users_super_admin'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 1)->count();


        return view('restaurant.foods.foods', compact('title', 'categories'));
    }

    public function dataFoods(){

        $foods = Food::select([
            'foods.id',
            'foods.name',
            'foods.description',
            'foods.food_category_id',
            'foods.updated_at',
            'foods.created_at'])
            ->orderBy('foods.created_at', 'DESC');

        return Datatables::of($foods)
        // ->addColumn('action', function($transaction) {
        //     return view('admin.compralo_mais.actions', compact('transaction'));
        // })
        ->escapeColumns('status')
        ->make(true);
    }

    public function createFood(Request $request){

        $rules = array(
            'name' => ['required', 'string'],
            'category' => ['required'],
        );

        if ($request->validate($rules)){
            $cat = FoodCategory::where('name', $request->category)->first();
            $result = Food::createFood($request->name, $request->description, $cat->id);

            if($result['status'] == true){
                return ['status' => true];
            }

            return ['status' => false, 'message' => 'Alimento já cadastrado!'];

        }
        return ['status' => false, 'message' => 'Erro ao criar alimento!'];
    }

    public function editFood(Request $request){
        $rules = array(
            'name' => ['required', 'string'],
            'category' => ['required'],
            'item_id' => ['required'],
        );

        if ($request->validate($rules)){

            $food_name = Food::where('name', $request->name)->first();
            if($food_name) return redirect()->back()->with('danger', 'Alimento já cadastrado!');

            $food = Food::find($request->item_id)->update([
                'name' => $request->name,
            ]);
            return ['status' => true];
        }
        return ['status' => false, 'message' => 'Erro ao alterar alimento!'];

    }

}
