<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $result = $client->post('http://67.207.95.144/api/mobile/v1/checkCode', [
            'json' => [
                'document_number' => $request->cpf,
                'billing_code' => $request->billing_code,
            ]
        ]);

        $res = json_decode($result->getBody()->getContents());

        if (isset($res)) {
            if ($res->status) {
                $user = auth('api')->user();

                $user->update([
                    'password' => bcrypt($request->password),
                    'cpf' => $request->cpf,
                    'billing_code' => $request->billing_code,
                    'first_access' => 0,
                ]);

                $user = auth('api')->user();

                $user->role_id = $user->roles->first()->id;

                return response()->json([ 'user' => $user ]);
            } else {
                return response()->json(["error" => "Ops, algo de errado", "message" => "Código da conta e/ou CPF incorretos"], 401);
            }
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Código da conta e/ou CPF incorretos"], 401);
        }
    }

    public function changeToken(Request $request) {
        $user = auth('api')->user();

        $user->update([
            'token_push' => $request->token_push
        ]);

        return response()->json([ 'user' => $user ]);
    }
}
