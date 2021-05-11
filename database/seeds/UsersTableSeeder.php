<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Defender::createRole('superadmin');
        $roleAdmin = Defender::createRole('admin');
        $roleUser = Defender::createRole('user');
        $roleRestaurantUser = Defender::createRole('restaurantuser');

        $superAdminadmin = App\User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@meualmoco.dev',
            'password' => Hash::make('admin'),
            'cpf' => '11111111111',
            'compralo_code' => 'BRC9776DD',
            'email_token' => 'superadmintoken'
        ]);

        $admin = App\User::create([
            'name' => 'Admin',
            'email' => 'admin@meualmoco.dev',
            'password' => Hash::make('admin'),
            'cpf' => '22222222222',
            'compralo_code' => 'CCC6776DD',
            'email_token' => 'admintoken'
        ]);

        $user = App\User::create([
            'name' => 'User',
            'email' => 'user@meualmoco.dev',
            'password' => Hash::make('user'),
            'cpf' => '33333333333',
            'compralo_code' => 'MKC277655',
            'email_token' => 'usertoken'
        ]);

        $restaurantUser = App\User::create([
            'name' => 'Restaurant User',
            'email' => 'restaurantuser@meualmoco.dev',
            'password' => Hash::make('user'),
            'cpf' => '44444444444',
            'compralo_code' => 'TYC2C46P0',
            'email_token' => 'restaurantusertoken'
        ]);

        $admin->attachRole($roleAdmin);
        $superAdminadmin->attachRole($roleSuperAdmin);
        $user->attachRole($roleUser);
        $restaurantUser->attachRole($roleRestaurantUser);
    }
}
