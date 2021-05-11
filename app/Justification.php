<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected $table = 'foods';
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'user_id',
        'user_head_id',
        'user_head_id',
        'food_orders_id',
        'description',
        'justification_img_link',
    ];
}
