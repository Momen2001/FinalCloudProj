<?php

namespace Database\Seeders;

use App\Models\DoctorSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    // php artisan db:seed --class=DoctorTableSeeder

    public function run()
    {
        $doctor = [
            'role_id' => 4, //doctor
            'first_name' => 'kareem',
            'last_name' => 'doctor2',
            'birth_date' => '2014-08-02',
            'gender' => 'male',
            'phone' => '123654742',
            'intro' => '966',
            'email' => 'doctor2@doctor.com',
            'platform' => 'android',
            'password' => bcrypt('123456Kk@'),
            'remember_token' => null,
            'verified' => 1,
            'verified_at' => '2022-06-15 13:47:44',
            'verification_token' => '',
            'two_factor_code' => '',
            'country_id' => 1,
            'city_id' => 1,
            'trust_phone' => 1,
        ];
        $doctor = User::query()->create($doctor);
        $user_setting = [
            'doctor_id' => $doctor->id,
            'hospital_id' => 2, //hospital
            'experience_start_work' => '2022-11-05',
            'emergency_online_price' => '55',
            'emergency_home_visit_price' => '66',
            'online_price' => '99',
            'home_visit_price' => '120',
            'in_hospital_price' => '15',
            'can_work_emergency_online' => 1,
            'can_work_online' => 1,
            'can_work_emergency_home_visit' => 1,
            'can_work_in_home_visit' => 1,
            'can_work_in_hospital' => 1,
            'speciality' => "general doctor",
            'speciality_en' => "general doctor",
            'license' => "1234568901",
            'bio' => "Doctor bio",
            'bio_en' => "Doctor bio",
            'education' => "education test string education test string ",
            'experience' => "experience test string experience test string ",
        ];
        DoctorSetting::query()->create($user_setting);
    }
}
