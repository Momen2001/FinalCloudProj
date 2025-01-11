<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\MainService;
use Illuminate\Database\Seeder;

class GeneralSeeder extends Seeder
{
    // php artisan db:seed --class=GeneralSeeder

    public function run()
    {
        $country_info =
            [
                'ar' => [
                    'title' => "السعودية",
                ],
                'en' => [
                    'title' => "saudia",
                ],
                'status' => 1,
                'phone_code' => 966,
                'iso3' => 'SAU',
                'iso2' => 'SA',
                'timezone' => 'Asia/Riyadh',
            ];
        Country::query()->create($country_info);

        $country_info =
            [
                'ar' => [
                    'title' => "فلسطين",
                ],
                'en' => [
                    'title' => "palestine",
                ],
                'status' => 1,
                'phone_code' => 972,
                'iso3' => 'PSE',
                'iso2' => 'PS',
                'timezone' => 'Asia/Gaza',

            ];
        $country = Country::query()->create($country_info);


//        $path = 'CountriesSeed.sql';
//        DB::unprepared(file_get_contents($path));
//        $first_country=  Country::query()->first()->id;
//
//        $path = 'CountriesSeed.sql';
//        DB::unprepared(file_get_contents($path));


        $city_info =
            [
                'ar' => [
                    'title' => "مدينة الرياض",
                ], 'en' => [
                'title' => "riyadh",
            ],
                'status' => 1,
                'country_id' => 1,
            ];
        City::query()->create($city_info);

        $main_service =
            [
                'ar' => [
                    'title' => "المختبرات",
                ],
                'en' => [
                    'title' => "Lab",
                ],
                'id' => 7,
                'is_urgent' => 0,
                'status' => 1,
                'photo' => 'lab.png',
                'scenario_develop' => 6,
                'filter_develop' => 1,

            ];
        MainService::query()->create($main_service);

    }
}
