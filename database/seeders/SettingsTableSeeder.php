<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    // php artisan db:seed --class=SettingsTableSeeder

    public function run()
    {
        $data = [];
        $data[0] = [
            'ar' => [
                'value' => "fالصحة العالمية هي شركة مرخصة من قبل وزارة الصحة السعودية وتحمل ترخيص رقم 14261807",
            ],
            'en' => [
                'value' => "Moh is a company licensed by the Saudi Ministry of Health and holds license number 14261807.
                ",
            ],
            'key' => 'patient_home_note',
            'active' => 1,
        ];

        $data[1] = [
            'ar' => [
                'value' => "15",
            ],
            'en' => [
                'value' => "15",
            ],
            'key' => 'vat',
            'active' => 1,
        ];


        $data[2] = [
            'ar' => [
                'value' => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.  إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع. ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العر. هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.",
            ],
            'en' => [
                'value' => "terms ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups  Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.",
            ],
            'key' => 'terms',
            'active' => 1,
        ];
        $data[3] = [
            'ar' => [
                'value' => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العر.",
            ],
            'en' => [
                'value' => "policy ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.",
            ],
            'key' => 'policy',
            'active' => 1,
        ];

        $data[4] = [
            'ar' => [
                'value' => "فلسطين - غزة , يافا  , شارع 1120/25",
            ],
            'en' => [
                'value' => "Palestine , Gaza , Yafa ST 3113 / 2A",
            ],
            'key' => 'address',
            'active' => 1,
        ];
        $data[5] = [
            'ar' => [
                'value' => "+972  599  999  999",
            ],
            'en' => [
                'value' => "+972  599  999  999",
            ],
            'key' => 'mobile',
            'active' => 1,
        ];
        $data[6] = [
            'ar' => [
                'value' => "support@moh.com",
            ],
            'en' => [
                'value' => "support@moh.com",
            ],
            'key' => 'email',
            'active' => 1,
        ];
        $data[7] = [
            'ar' => [
                'value' => "https://www.facebook.com/hsh.gaza",
            ],
            'en' => [
                'value' => "https://www.facebook.com/hsh.gaza",
            ],
            'key' => 'facebook',
            'active' => 1,
        ];
        $data[8] = [
            'ar' => [
                'value' => "https://twitter.com/HnhQassim",
            ],
            'en' => [
                'value' => "https://twitter.com/HnhQassim",
            ],
            'key' => 'twitter',
            'active' => 1,
        ];
        $data[9] = [
            'ar' => [
                'value' => "https://www.instagram.com/",
            ],
            'en' => [
                'value' => "https://www.instagram.com/",
            ],
            'key' => 'instagram',
            'active' => 1,
        ];
        $data[10] = [
            'ar' => [
                'value' => "https://www.linkedin.com/feed/",
            ],
            'en' => [
                'value' => "https://www.linkedin.com/feed/",
            ],
            'key' => 'linkedin',
            'active' => 1,
        ];

        $data[11] = [
            'ar' => [
                'value' => "24.774265",
            ],
            'en' => [
                'value' => "24.774265",
            ],
            'key' => 'hakeem_lat',
            'active' => 1,
        ];

        $data[12] = [
            'ar' => [
                'value' => "46.738586",
            ],
            'en' => [
                'value' => "46.738586",
            ],
            'key' => 'hakeem_long',
            'active' => 1,
        ];
        $data[13] = [
            'ar' => [
                'value' => " سياسة الدفع وخصوصية الاسترداد في برنامج الصحة العالمية كتالي  سياسة الدفع وخصوصية الاسترداد في الصحة للرعاية الطبية  كتالي",
            ],
            'en' => [
                'value' => "Payment policy and refund privacy in the application of Hakim  Payment policy and privacy of refund in the application of Hakim ",
            ],
            'key' => 'payment_and_refund_policy',
            'active' => 1,
        ];
        $data[14] = [
            //Refund amount before 24 hours
            'ar' => [
                'value' => "0",
            ],
            'en' => [
                'value' => "0",
            ],
            'key' => 'before_24_h',
            'active' => 1,
        ];

        $data[15] = [
            //Refund amount before 12 hours
            'ar' => [
                'value' => "20",
            ],
            'en' => [
                'value' => "20",
            ],
            'key' => 'before_12_h',
            'active' => 1,
        ];

        $data[16] = [
            //Refund amount before 50 hours

            'ar' => [
                'value' => "50",
            ],
            'en' => [
                'value' => "50",
            ],
            'key' => 'before_6_h',
            'active' => 1,
        ];

        foreach ($data as $index => $value) {
            Setting::create($data[$index]);
        }
    }
}















