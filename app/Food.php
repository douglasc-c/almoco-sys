<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    protected $table = 'foods';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'food_category_id',
    ];


    public static function createFood($name, $description, $category){

        $food = Food::create([
            'name' => $name,
            'description' => $description,
            'food_category_id' => $category,
        ]);

        if($category){
            return ['status' => true, 'category' => $food];

        }else{
            return ['status' => false, 'message' => 'Erro ao criar alimento!'];
        }
        return ['status' => false, 'message' => 'Erro ao criar alimento!'];
    }
}
