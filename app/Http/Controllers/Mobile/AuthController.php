<?php

namespace App\Http\Controllers\Mobile;

use App\Log;
use JWTAuth;
use App\User;
use Exception;
use App\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Artesaos\Defender\Facades\Defender;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        try {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(["error" => "Erro login/senha", "message" => "Verifique os dados informados e tente novamente"], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível entrar, tente novamente mais tarde'], 500);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout(true);

        return response()->json(['message' => 'Saiu com sucesso ']);
    }

    public function refresh()
    {
        $user = auth('api')->user();

        return response()->json([
            'access_token' => auth('api')->refresh(),
            'user' => $user,
        ]);
    }

    public function forgot(Request $request)
    {
        $rules = array(
            'email' => "required|email",
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["error" => "Ocorreu um erro", "message" => $validator->errors()->first()], 400);
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json(["message" => "E-mail enviado com sucesso"]);
                    case Password::INVALID_USER:
                        return response()->json(["error" => "Ocorreu um erro", "message" => "E-mail não encontrado"], 400);
                }
            } catch (\Swift_TransportException $ex) {
                return response()->json(["error" => "Ocorreu um erro", "message" => "Tente novamente mais tarde"], 400);
            } catch (Exception $ex) {
                return response()->json(["error" => "Ocorreu um erro", "message" => "Tente novamente mais tarde"], 400);
            }
        }
    }

    protected function respondWithToken($token)
    {
        $user = auth('api')->user();

        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ]);
    }
}
