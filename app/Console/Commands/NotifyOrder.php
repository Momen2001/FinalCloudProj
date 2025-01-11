<?php

namespace App\Console\Commands;

use App\Jobs\SendFcmNotificationOrder;
use App\Jobs\SendTaqnyatSms;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyOrder extends Command
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
    protected $description = 'Reminder of the approaching reservation time before 10 minutes';

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
        $orders = Order::query()->where('status', OrderStatus()['awaitingImplementation'])->whereNull('reminded_at')->get();
        foreach ($orders as $order) {
            $bookingTime = $order->booking_date . ' ' . $order->booking_hour;
            $bookingTimeSubMinute = Carbon::parse($bookingTime)->subMinute(10)->format('Y-m-d H:i');
            $carbonNow = Carbon::now()->format('Y-m-d H:i');
            if (($carbonNow >= $bookingTimeSubMinute) && ($carbonNow <= $bookingTime)) {

                //send notification FCM & SMS
                $msgForPatient = trans('cruds.patient_reminder_of_the_approaching_reservation', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status],]);
                $msgForHospital = trans('cruds.hospital_reminder_of_the_approaching_reservation', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status],]);
                $msgForDoctor = trans('cruds.doctor_reminder_of_the_approaching_reservation', ['order_id' => $order->order_id, 'booking_date' => $order->booking_date, 'booking_hour' => $order->booking_hour, 'booking_status' => OrderStatusByNumber()[$order->status],]);
                $title = trans('global.reminder_of_the_approaching_application_date');

                dispatch(new SendTaqnyatSms($msgForPatient, $order->ownerPatient->getFullPhone()));
                dispatch(new SendFcmNotificationOrder($order->ownerPatient, $title, $msgForPatient, $order)); //send fcm to owner patient
                if ($order->hospital_id) {
                    dispatch(new SendTaqnyatSms($msgForHospital, $order->hospital->getFullPhone()));
                } elseif ($order->doctor) {
                    dispatch(new SendTaqnyatSms($msgForDoctor, $order->doctor->getFullPhone()));
                    dispatch(new SendTaqnyatSms($msgForDoctor, $order->doctor->doctorSetting->hospital->getFullPhone()));
                }

                $order->reminded_at = Carbon::now();
                $order->update();
            }
        }
    }
}
