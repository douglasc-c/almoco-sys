<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class UserController extends Controller
{
    public function update(Request $request) {
        $client = new \GuzzleHttp\Client();
        $result = $client->post('http://a5946f03dfc0.ngrok.io/api/mobile/v1/checkCode', [
            'json' => [
                'document_number' => $request->document_number,
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
                ]);

                $user = auth('api')->user();

                return response()->json([ 'user' => $user ]);
            } else {
                return response()->json(["error" => "Ops, algo de errado", "message" => "Código da conta e/ou CPF incorretos"], 401);
            }
        } else {
            return response()->json(["error" => "Ops, algo de errado", "message" => "Código da conta e/ou CPF incorretos"], 401);
        }
    }
}
