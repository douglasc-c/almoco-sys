<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Food;

class Menu extends Model
{
    protected $table = 'menus';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_day',
        'foods_id',
    ];

    public static function getMenu(){
        $menus_selected = Menu::orderBy('menu_day', 'DESC')->limit(6)->get();

        foreach($menus_selected as $menu){
            $menus[$menu->menu_day]['day'] = $menu->menu_day;
            $menus[$menu->menu_day]['id'] = $menu->id;
            $foods = json_decode($menu->foods_id);
            $foods_name = [];
            $foods_id = [];
            foreach($foods as $food){
                // $food_find = Food::find($food);
                // $food_name = array_push($foods_name, $food_find->name);
                // $food_id = array_push($foods_id, $food_find->id);
                $food_find = Food::find($food);
                $foods_result[$food_find->id]['id'] = $food_find->id;
                $foods_result[$food_find->id]['name'] = $food_find->name;
                // $food_name = array_push($foods_name, $food_find->name);
                // $food_id = array_push($foods_id, $food_find->id);
            }
            $menus[$menu->menu_day]['itens'] = $foods_result;
            // $menus[$menu->menu_day]['itens_name'] = $foods_name;
            // $menus[$menu->menu_day]['itens_id'] = $foods_id;
        }

        return $menus;
    }
}
