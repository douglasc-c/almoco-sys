<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'type',
        'description',
        'ip',
    ];

    public function typeColor(){
        if($this->type == 'bonus') return 'success';
        if($this->type == 'profile') return 'info';
        if($this->type == 'auth') return 'warning';

        return '';
    }

    /**
	 * Get the user.
	 *
	 * @return User
	 */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
