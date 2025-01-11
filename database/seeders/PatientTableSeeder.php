<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PatientTableSeeder extends Seeder
{
    // php artisan db:seed --class=PatientTableSeeder


    public function run()
    {
        $users = [
            [
                'first_name' =>'patient',
                'last_name' => 'test',
                'birth_date' => '2014-08-02',
                'country_id' => 1,
                'passport_id' => '10251603200',
                'phone' => '123654785',
                'intro' => '966',
                'email' => 'patient@patient.com',
                'password' => bcrypt('123456Kk@'),
                'confirm_condition' => 1,
                'fcm_notification' => 'fdfwerrtyerteterccxvbdsateyuyt876rrtgfbnjcrtfhbsrdg',
                'gender' => 'male',
                'insurance_comp_id' => null,
                'trust_phone' => 1,
                'code' => 1234,
                'role_id' => 3, //Patient
                'platform' => 'ios',
            ],
        ];
        User::insert($users);
    }
}
