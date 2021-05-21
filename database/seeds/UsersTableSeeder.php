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
        $roleManager = Defender::createRole('manager');
        $roleArm = Defender::createRole('arm');
        $roleUser = Defender::createRole('user');
        $roleRestaurantUser = Defender::createRole('restaurantuser');

        $superAdminadmin = App\User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@meualmoco.dev',
            'password' => Hash::make('admin'),
            'cpf' => '11111111111',
            'billing_code' => 'BRC9776DD',
            'email_token' => 'superadmintoken'
        ]);

        $manager = App\User::create([
            'name' => 'Manager',
            'email' => 'manager@meualmoco.dev',
            'password' => Hash::make('manager'),
            'cpf' => '22222222222',
            'billing_code' => 'CCC6776DD',
            'email_token' => 'managertoken'
        ]);

        $arm = App\User::create([
            'name' => 'Arm',
            'email' => 'arm@meualmoco.dev',
            'password' => Hash::make('arm'),
            'cpf' => '33333333333',
            'billing_code' => 'BCC6776DD',
            'email_token' => 'armtoken'
        ]);

        $user = App\User::create([
            'name' => 'User',
            'email' => 'user@meualmoco.dev',
            'password' => Hash::make('user'),
            'cpf' => '44444444444',
            'billing_code' => 'MKC277655',
            'email_token' => 'usertoken'
        ]);

        $restaurantUser = App\User::create([
            'name' => 'Restaurant User',
            'email' => 'restaurantuser@meualmoco.dev',
            'password' => Hash::make('user'),
            'cpf' => '55555555555',
            'billing_code' => 'TYC2C46P0',
            'email_token' => 'restaurantusertoken'
        ]);

        $superAdminadmin->attachRole($roleSuperAdmin);
        $manager->attachRole($roleManager);
        $arm->attachRole($roleArm);
        $user->attachRole($roleUser);
        $restaurantUser->attachRole($roleRestaurantUser);
    }
}
