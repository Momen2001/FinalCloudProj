<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    // php artisan db:seed --class=UsersTableSeeder

    public function run()
    {
        $users = [
            [
                'id' => 1,
                'role_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'birth_date' => '2014-08-02',
                'gender' => 'male',
                'phone' => '0592782897',
                'intro' => '966',
                'email' => 'admin@admin.com',
                'platform' => 'web',
                'password' => bcrypt('123456Kk@'),
                'remember_token' => null,
                'verified' => 1,
                'trust_phone' => 1,
                'verified_at' => '2022-06-15 13:47:44',
                'verification_token' => '',
                'two_factor_code' => '',
            ],
        ];
        User::insert($users);
    }
}
