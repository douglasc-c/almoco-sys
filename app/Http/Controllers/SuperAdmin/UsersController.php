<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Artesaos\Defender\Facades\Defender;
use App\Mail\UserRegister;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function index(){
        // $user = new User;
        $user_id = 6;
        $name = 'william moraes';
        $password = '654321';
        $cpf = '07552897902';
        $billing_code = 'B45HDF67';
        $new_user = User::completeRegister($user_id, $name, $password, $cpf, $billing_code);

        $title = 'Usuários';
        $total['users_super_admin'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 1)->count();
        $total['users_admin'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 2)->count();
        $total['users'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 3)->count();
        $total['users_restaurant'] = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_id', 4)->count();

        return view('superadmin.users.index', compact('title', 'total'));
    }

    public function dataUsers(){
        $users = User::select([
            'users.id',
            'users.name',
            'users.billing_code',
            'users.email',
            'users.cpf',
            'users.created_at',
            'users.updated_at'])
            ->orderBy('users.created_at', 'DESC');

        return Datatables::of($users)
        // ->addColumn('action', function($transaction) {
        //     return view('admin.compralo_mais.actions', compact('transaction'));
        // })
        ->escapeColumns('status')
        ->make(true);
    }

    public function createUser(Request $request){
        $rules = array(
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        );
        $email_token = str_random(15);
        
        if ($request->validate($rules)){
            $random_password = str_random(8);
            $arm = User::find($request->arm);
            if($arm){
                $arm_id = $arm->id;
            }else{
                $arm_id = null;
            }
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($random_password),
                'email_token' => $email_token,
                'arm_id' => $arm_id,
            ]);

            if($user){
                $role = Defender::findRole('user');
                $user->attachRole($role);

                Mail::to($user->email)->send(new UserRegister($user, $random_password));

                return redirect()->back()->with('success', 'Usuário criado com sucesso!');
            }else{
                return redirect()->back()->with('danger', 'Erro ao criar usuário');
            }
        }
        return redirect()->back()->with('danger', 'Erro ao criar usuário');
    }
}
