<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Admin seeder
//        User::create([
//            'role_id' => 1,
//            'name' => 'Mr. Admin',
//            'email' => 'admin@gmail.com',
//            'phone' => '01700000000',
//            'username' => 'admin',
//            'password' => Hash::make('12345'),
//            'user_type' => 'admin',
//            'status' => 1,
//        ]);


        //Recruiting Agency seeder
//        User::create([
//            'role_id' => 2,
//            'name' => 'BMET',
//            'email' => 'bmet@gmail.com',
//            'phone' => '01700000002',
//            'username' => 'bmet',
//            'password' => Hash::make('12345'),
//            'user_type' => 'bmet',
//            'status' => 1,
//        ]);



        //Recruiting Agency seeder
//        User::create([
//            'role_id' => 3,
//            'name' => 'M.E.F Global',
//            'email' => 'mef@gmail.com',
//            'phone' => '01700000003',
//            'username' => 'recruiting-agency',
//            'password' => Hash::make('12345'),
//            'user_type' => 'recruiting-agency',
//            'status' => 1,
//            'active_status' => 1,
//        ]);

        //Foreign Ministry seeder
        User::create([
            'role_id' => 4,
            'name' => 'Foreign Ministry',
            'email' => 'ministry@gmail.com',
            'phone' => '01425256528',
            'username' => 'foreign-ministry',
            'password' => Hash::make('12345'),
            'user_type' => 'foreign-ministry',
            'status' => 1,
            'active_status' => 1,
        ]);

    }
}
