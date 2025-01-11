<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    // php artisan db:seed --class=PaymentMethodSeeder

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
                    'title' => "الدفع أون لاين بي تاب",
                ],
                'en' => [
                    'title' => "paytabs",
                ],
                'photo' => "online-payment.png",
                'status' => 1,
                'is_online' => 1,
            ];
        PaymentMethod::query()->create($paymentMethod);

        $paymentMethod =
            [
                'ar' => [
                    'title' => "الدفع في المركز",
                ],
                'en' => [
                    'title' => "Pay on center",
                ],
                'status' => 1,
                'is_online' => 0,
                'photo' => "pay-by-hand.jpg",
            ];
        PaymentMethod::query()->create($paymentMethod);
    }
}
