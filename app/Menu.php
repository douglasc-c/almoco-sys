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
        'id',
        'menu_day',
        'foods_id',
    ];

    public static function getMenu(){
        $menus_selected = Menu::orderBy('menu_day', 'DESC')->limit(6)->get();
        // dd($menus_selected);
        foreach($menus_selected as $menu){
            // dd($menu);
            $menus[$menu->menu_day]['day'] = $menu->menu_day;
            $menus[$menu->menu_day]['id'] = $menu->id;
            $foods = json_decode($menu->foods_id);

            foreach($foods as $food){
               
                $food_find = Food::find($food);
                $foods_result[$food_find->id]['id'] = $food_find->id;
                $foods_result[$food_find->id]['name'] = $food_find->name;
              
            }
            $menus[$menu->menu_day]['itens'] = $foods_result;
            $foods_result = [];
           
        }
        

        return $menus;
    }
}
