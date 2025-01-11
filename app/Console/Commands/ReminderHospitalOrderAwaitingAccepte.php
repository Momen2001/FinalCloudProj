<?php

namespace App\Console\Commands;

use App\Jobs\SendTaqnyatSms;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderHospitalOrderAwaitingAccepte extends Command
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
    protected $description = 'Reminding the hospital that there is a reservation waiting accept 20 minutes ago, the reservation status must be changed';

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
        $orders = Order::query()->where('status', OrderStatus()['awaitingAccept'])
            ->where('awaiting_accept_reminded', 0)->get();

        foreach ($orders as $order) {
            $orderCreatedAt = $order->created_at;
            $bookingCreatedAt = Carbon::parse($orderCreatedAt)->format('Y-m-d H:i');
            $twentyMinutesAgo = Carbon::now()->subMinutes(20)->format('Y-m-d H:i');

            if ($bookingCreatedAt <= $twentyMinutesAgo) {
                $providerMsg = trans('cruds.remember_reservation_still_waiting_to_accept', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status]]);

                if ($order->hospital_id) {
                    dispatch(new SendTaqnyatSms($providerMsg, $order->hospital->getFullPhone()));
                    $hospitalName = $order->hospital->getTranslationName();
                } elseif ($order->doctor) {
                    dispatch(new SendTaqnyatSms($providerMsg, $order->doctor->doctorSetting->hospital->getFullPhone()));
                    $hospitalName = $order->doctor->doctorSetting->hospital->getTranslationName();
                }

                $hakeemManagerMsg = trans('cruds.hakeem_remember_reservation_still_waiting_to_accept', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status], 'hospital_name' => $hospitalName]);
                dispatch(new SendTaqnyatSms($hakeemManagerMsg, getHakeemPhone()));

                $order->awaiting_accept_reminded = 1;
                $order->update();
            }
        }
    }
}
