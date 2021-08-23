<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

                if ($user->first_access == 1 || $user->first_access == true) {
                    $user->update([
                        'password' => bcrypt($request->password),
                        'name' => $request->name,
                        'cpf' => $request->cpf,
                        'billing_code' => $request->billing_code,
                        'first_access' => 0,
                    ]);
                } else {
                    if (!Hash::check($request->password, $user->password)) {
                        return response()->json([
                            "error" => "Ocorreu um erro", 
                            "message" => 'Senha atual não confere',
                            'pass' => $request->password,
                            'u_pass' => $user->password,
                            'hash' => Hash::check($request->password, $user->password)
                        ], 400);
                    }

                    $user->update([
                        'password' => bcrypt($request->newPassword),
                    ]);
                }

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
