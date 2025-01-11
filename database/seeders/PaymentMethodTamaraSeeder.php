<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTamaraSeeder extends Seeder
{
    // php artisan db:seed --class=PaymentMethodTamaraSeeder

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethod =
            [
                'ar' => [
                    'title' => "الدفع بالتقسيط",
                ],
                'en' => [
                    'title' => "Tamara Payment",
                ],
                'photo' => "tamara.png",
                'status' => 1,
                'is_online' => 1,
            ];
        PaymentMethod::query()->create($paymentMethod);
    }
}
