<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use App\User;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();

        return response()->json(['notifications' => $notifications]);
    }

    public function create(Request $request)
    {
        $user = auth('api')->user();

        $notification = Notification::create([
            'user_id' => $user->id,
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['notification' => $notification]);
    }

    public function update(Request $request)
    {
        if ($request->notification_id == 1
        || $request->notification_id == 2 
        || $request->notification_id == 3 
        || $request->notification_id == 4 
        || $request->notification_id == 5) {
            return response()->json([
                "error" => "Ops, algo de errado", 
                "message" => "Voçê não possuí permissão para deletar essa notificação"
            ], 401);
        }

        $user = auth('api')->user();

        $notification = Notification::find($request->notification_id);

        $notification->update([
            'user_id' => $user->id,
            'description' => $request->description,
            'status' => 1,
        ]);

        return response()->json(['notification' => $notification]);
    }

    public function delete(Request $request)
    {
        if ($request->notification_id == 1
        || $request->notification_id == 2 
        || $request->notification_id == 3 
        || $request->notification_id == 4 
        || $request->notification_id == 5) {
            return response()->json([
                "error" => "Ops, algo de errado", 
                "message" => "Voçê não possuí permissão para deletar essa notificação"
            ], 401);
        }

        $notification = Notification::find($request->notification_id);

        $notification->delete();

        return response()->json(['message' => 'Notificação deletada com sucesso']);
    }

    public function send(Request $request)
    {
        $notification = Notification::find($request->notification_id);

        $users = User::get();
        if ($notification) {
            foreach ($users as $user) {
                if ($user->token_push != null) {
                    $user->sendPush($notification->description, $user->token_push);
                }
            }

            return response()->json(['message' => 'Notificação enviada']);
        } else {
            return response()->json(['message' => 'Falha ao enviar notificação'], 400);
        }

    }
}
