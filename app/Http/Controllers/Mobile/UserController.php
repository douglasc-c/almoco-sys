<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth('api')->user();

        if ($user->first_access == 1 || $user->first_access == true) {
            $user->update([
                'password' => bcrypt($request->password),
                'cpf' => $request->cpf,
                'billing_code' => '-',
                'first_access' => 0,
            ]);
        } else {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    "error" => "Ocorreu um erro", 
                    "message" => 'Senha atual não confere',
                ], 400);
            }

            $user->update([
                'password' => bcrypt($request->newPassword),
            ]);
        }

        $user = auth('api')->user();

        $user->role_id = $user->roles->first()->id;

        return response()->json([ 'user' => $user ]);
    }

    public function changeToken(Request $request) {
        $user = auth('api')->user();

        $user->update([
            'token_push' => $request->token_push
        ]);

        return response()->json([ 'user' => $user ]);
    }
}
