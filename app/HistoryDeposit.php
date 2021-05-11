<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryDeposit extends Model
{
	   protected $fillable = [
    	'id', 
    	'user_id', 
    	'from_user',
    	'type',
    	'value',
    	'description',
    	'status',
    	'order_id'
    ];

	protected $table = 'history_deposits';

	public static function releasePoint(User $user, $point_value, $deposit, $order_id, $type='lending', $manual = false){

		$level = 1;
		$limit = 20;
		$user_function = $user;

        // Run network to up
		while ($level <= $limit) {
            if($user_function = User::find($user_function->sponsor)){

                $historyPointStarsClub = New HistoryDeposit;
                $historyPointStarsClub->user_id = $user_function->id;
                $historyPointStarsClub->from_user = $user->id;
                $historyPointStarsClub->type = $type;
                $historyPointStarsClub->level = $level;
                $historyPointStarsClub->value = $point_value;
                $historyPointStarsClub->description = 'Staking (#'.$deposit->token.') of '.number_format($point_value, 2).' from '.$user->code;
                $historyPointStarsClub->status = 1;
                $historyPointStarsClub->order_id = $order_id;
                $historyPointStarsClub->created_at = date('Y-m-d H:i:s');
                $historyPointStarsClub->updated_at = date('Y-m-d H:i:s');
                $historyPointStarsClub->save();

                $level++;
            }else{
                break;
            }
        }

	}

	public static function checkPoints(User $user, $type='lending'){

		$levels = [];

		$active = false;
		if($type == 'lending'){
            $active = (DepositLending::where('user_id', $user->id)->where('status', 1)->first()) ? true : false;
        }

		if($active){
			$points['total'] = bcdiv(HistoryDeposit::where('user_id', $user->id)->where('type', $type)->sum('value'), 1, 2);

			for ($x = 1; $x <= 8; $x++){
				$levels[$x] = bcdiv(HistoryDeposit::where('user_id', $user->id)->where('level', $x)->where('type', $type)->sum('value'), 1, 2);
			}

		}else{
			$points['total'] = bcdiv(0, 1, 2);

			for ($x = 1; $x <= 8; $x++){
				$levels[$x] = bcdiv(0, 1, 2);
			}
		}

		$total = bcdiv($points['total'], 1, 2);

		return ['levels' => $levels, 'total' => $total];

	}

}