<?php

namespace App\Console\Commands;

use App\Jobs\SendTaqnyatSms;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderHospitalOrderMustCompleted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminding the hospital that there is a reservation must be completed,this jop run every 20 minute';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::query()->where('status', OrderStatus()['inProgress'])->get();

        foreach ($orders as $order) {
            $bookingTime = $order->booking_date . ' ' . $order->booking_hour;
            $bookingTimeAddMinutes = Carbon::parse($bookingTime)->addMinutes(15)->format('Y-m-d H:i');
            $carbonNow = Carbon::now()->format('Y-m-d H:i');

            if ($bookingTimeAddMinutes <= $carbonNow) {
                $providerMsg = trans('cruds.remember_reservation_must_be_completed', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status]]);

                if ($order->hospital_id) {
                    dispatch(new SendTaqnyatSms($providerMsg, $order->hospital->getFullPhone()));
                    $hospitalName = $order->hospital->getTranslationName();
                } elseif ($order->doctor) {
                    dispatch(new SendTaqnyatSms($providerMsg, $order->doctor->doctorSetting->hospital->getFullPhone()));
                    $hospitalName = $order->doctor->doctorSetting->hospital->getTranslationName();
                }
                $hakeemManagerMsg = trans('cruds.hakeem_remember_reservation_must_completed', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status], 'hospital_name' => $hospitalName]);
                dispatch(new SendTaqnyatSms($hakeemManagerMsg, getHakeemPhone()));
            }
        }
    }
}
