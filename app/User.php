<?php

namespace App;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasDefender;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'billing_code',
        'remember_tokem',
        'email_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_token'
    ];

    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPasswordNotification($token));
    }

    public static function completeRegister($user_id, $name, $password, $cpf, $billing_code){
        $user = User::find($user_id);
        if($user){
            $user->update([
                'name' => $name,
                'password' => bcrypt($password),
                'cpf' => $cpf,
                'billing_code' => $billing_code,
            ]);

            return $user;
        }else{
            return false;
        }
    }

}
