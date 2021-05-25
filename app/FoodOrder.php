<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    protected $table = 'food_orders';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'itens_selected',
        'status_id',
        'user_id',
        'menu_id',
    ];

    public function menu() {
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}
