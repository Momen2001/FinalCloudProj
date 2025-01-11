<?php

namespace Database\Seeders;


use App\Models\MainService;
use App\Models\RejectReason;
use Illuminate\Database\Seeder;

class RejectReasonsSeeder extends Seeder
{
    // php artisan db:seed --class=RejectReasonsSeeder

    public function run()
    {
        $rejectReason =
            [
                'ar' => [
                    'description' => "سبب مخصص",
                ],
                'en' =>[
                    'description' => "Custom reason",
                ],
            ];
        RejectReason::query()->create($rejectReason);

        $rejectReason =
            [
                'ar' => [
                    'description' => "خلل في التأمين",
                ],
                'en' =>[
                    'description' => "Problem Insurance",
                ],
            ];
        RejectReason::query()->create($rejectReason);

        $rejectReason =
            [
                'ar' => [
                    'description' => "خلل في الحجز",
                ],
                'en' =>[
                    'description' => "Fail Booking",
                ],
            ];
        RejectReason::query()->create($rejectReason);

        $rejectReason =
            [
                'ar' => [
                    'description' => "الطبيب غير متاح",
                ],
                'en' =>[
                    'description' => "Doctor not available",
                ],
            ];
        RejectReason::query()->create($rejectReason);

        $rejectReason =
            [
                'ar' => [
                    'description' => "الطبيب لم يحضر",
                ],
                'en' =>[
                    'description' => "Doctor not coming",
                ],
            ];
        RejectReason::query()->create($rejectReason);

          $rejectReason =
            [
                'ar' => [
                    'description' => "المريض لم يحضر",
                ],
                'en' =>[
                    'description' => "Patient not coming",
                ],
            ];
        RejectReason::query()->create($rejectReason);




    }
}
