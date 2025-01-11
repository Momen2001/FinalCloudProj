<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementsSeeder extends Seeder
{
    // php artisan db:seed --class=AdvertisementsSeeder

    public function run()
    {

        $advertisement =
            [
                'ar' => [
                    'title' => "عنوان الاعلان التجريبي",
                    'description' => "وصف الاعلان التجريبي",
                    'btn_text' => "احجز الان",
                ],
                'en' => [
                    'title' => "Test title advertisement ",
                    'description' => "Test description advertisement ",
                    'btn_text' => "Reserve now",
                ],
                'link' => "https://saidatowerssouthpadre.com/",
                'status' => 1,
                'btn_show' => 1,
                'color_degree' => '#ced514',
                'photo' => null,
            ];
        Advertisement::query()->create($advertisement);

        $advertisement =
            [
                'ar' => [
                    'title' => "عنوان الاعلان التجريبي",
                    'description' => "وصف الاعلان الجديد",
                ],
                'en' => [
                    'title' => "Test title advertisement ",
                    'description' => "First Description Advertisement ",
                ],
                'link' => null,
                'status' => 1,
                'btn_show' => 0,
                'color_degree' => '#11bec2',
                'photo' => null,
            ];
        Advertisement::query()->create($advertisement);


        $advertisement =
            [
                'ar' => [
                    'title' => "عنوان الشركة المعلنة",
                    'description' => "الشركة العالمية الصحية",
                    'btn_text' => "انقر هنا",
                ],
                'en' => [
                    'title' => "Test title advertisement ",
                    'description' => "New Card Description",
                    'btn_text' => "Click here",
                ],
                'link' => null,
                'status' => 1,
                'btn_show' => 1,
                'color_degree' => '#0ed22c',
                'photo' => null,
            ];
        Advertisement::query()->create($advertisement);

    }
}
