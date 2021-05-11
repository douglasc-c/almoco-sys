<?php

namespace App\Http\Controllers\SuperAdmin;

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
    public function foodCategoriesIndex(){

        $title = 'Catgorias de Alimentos';
        // $categories = FoodCategory::all();
        // dd($categories);
        // $total['users_super_admin'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 1)->count();


        return view('superadmin.foods.food_categories', compact('title'));
    }

    public function foodIndex(){

        $title = 'Alimentos';
        // $categories = FoodCategory::all();
        // dd($categories);
        // $total['users_super_admin'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 1)->count();


        return view('superadmin.foods.index', compact('title'));
    }

    public function dataFoodsCategories(){

        $categories = FoodCategory::select([
            'food_categories.id',
            'food_categories.name',
            'food_categories.description',
            'food_categories.updated_at',
            'food_categories.created_at'])
            ->orderBy('food_categories.created_at', 'DESC');

        return Datatables::of($categories)
        // ->addColumn('action', function($transaction) {
        //     return view('admin.compralo_mais.actions', compact('transaction'));
        // })
        ->escapeColumns('status')
        ->make(true);
    }

    public function dataFoods(){

        $foods = Food::join('food_categories', 'food_categories.id', '=', 'foods.food_category_id')->select([
            'foods.id',
            'foods.name',
            'food_categories.name as food_category',
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

    public function createCategory(Request $request){

        $rules = array(
            'name' => ['required', 'string'],
        );

        if ($request->validate($rules)){
            $result = FoodCategory::createCategory($request->name, $request->description);

            if($result['status'] == true){
                return redirect()->back()->with('success', 'Categoria criada com sucesso!');
            }

        }
        return redirect()->back()->with('danger', 'Erro ao criar usuário');
    }


}
