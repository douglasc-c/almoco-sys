<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $table = 'food_categories';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'created_at'
    ];

    public static function createCategory($name, $description){

        $category = FoodCategory::create([
            'name' => $name,
            'description' => $description,
        ]);

        if($category){
            return ['status' => true, 'category' => $category];

        }else{
            return ['status' => false, 'message' => 'Erro ao criar categoria!'];
        }
        return ['status' => false, 'message' => 'Erro ao criar categoria!'];
    }
}
