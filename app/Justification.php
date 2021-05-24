<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected $table = 'justifications';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_id',
        'user_arm_id',
        'food_orders_id',
        'description',
        'justification_img_link',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function food_order() {
        return $this->hasOne(FoodOrder::class, 'id', 'food_orders_id');
    }
}
