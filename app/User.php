<?php

namespace App;

use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;



use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
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
        'first_access',
        'token_push',
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

    public static function completeRegister($user_id, $name, $password, $cpf, $billing_code) {
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

    public static function sendPush($text ,$token_push){
        $data = array(
           "to" => $token_push,
           "notification" => [
            "title" => 'Aviso',
            "sound" => "default",
            "body" => $text,
            ],
        );

        $data = json_encode($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
              "Authorization: key=AAAAsenbvAI:APA91bHEcLYHYp7QLRUPKkHTRbcJhrP_0JT4S9oh80PHuGTCjxqxucMtg1VXlRdn3_DNLFT8pRFxKJ5Z2a6RyipB_Rto6jflEUBi7q4AHm_xFXtRRAzFRD8RWGfj1w8UGRGCB5kjGErO",
              "Content-Type: application/json",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);

        if($response && isset($response->success) && $response->success){
            return true;
        }
        return false;
    }

    public function justifications() {
        return $this->hasMany(Justification::class, 'user_id', 'id');
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
}
