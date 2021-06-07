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

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function justification() {
        return $this->belongsTo(Justification::class, 'id', 'food_orders_id');
    }

    public function menu() {
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}
