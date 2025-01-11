<?php


namespace Database\Seeders;

use App\Models\ReportType;
use Illuminate\Database\Seeder;

class MedicalReportTypeSeeder extends Seeder
{
    // php artisan db:seed --class=ReportTypeSeeder

    public function run()
    {

        $ReportType =
            [
                'ar' => [
                    'title' => "المختبرات",
                ],
                'en' => [
                    'title' => "Lab",
                ],
                'color' => "0xFFD753FD",
                'photo' => 'lab.png',
            ];
        ReportType::query()->create($ReportType);
        $ReportType =
            [
                'ar' => [
                    'title' => "الفيتامينات",
                ],
                'en' => [
                    'title' => "Vitamin",
                ],
                'color' => "0xFF7E53FD",
                'photo' => 'vitamine.png',
            ];
        ReportType::query()->create($ReportType);

        $ReportType =
            [
                'ar' => [
                    'title' => "الأشعة",
                ],
                'en' => [
                    'title' => "Radiology",
                ],
                'color' => "0xFFD753FD",
                'photo' => 'radiology.png',
            ];
        ReportType::query()->create($ReportType);

        $ReportType =
            [
                'ar' => [
                    'title' => "التطعيمات",
                ],
                'en' => [
                    'title' => "Vaccine",
                ],
                'color' => "0xFFD753FD",
                'photo' => 'vaccine.png',
            ];
        ReportType::query()->create($ReportType);


    }
}
