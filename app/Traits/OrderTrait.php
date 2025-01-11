<?php

namespace App\Traits;

use App\Jobs\SendFcmNotificationOrder;
use App\Jobs\SendTaqnyatSms;
use App\Models\MainService;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\RejectReason;
use App\Models\RejectReasonOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait OrderTrait
{
    public function indexTrait($orderStatus): array
    {
        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();

        $data['orders'] = Order::query()
            ->when($orderStatus, function ($qq) use($orderStatus){
                return $qq->where('status',$orderStatus);
            })
            ->where(function ($query) use ($hospitalDoctors, $hospitalId) {
                $query->whereIn('doctor_id', $hospitalDoctors)
                    ->orWhere('hospital_id', $hospitalId);
            })
            ->orderBy('id', 'DESC')
            ->get();
        return $data;
    }

    public function editTrait($mainServiceId): array
    {
        $data['main_service'] = MainService::query()->find($mainServiceId);
        return $data;
    }


    public function orderStartWorkTrait($orderId)
    {

        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        $order = Order::query()->where('status', OrderStatus()['awaitingImplementation'])->findOrFail($orderId);
        if ($order->hospital_id == $hospitalId || in_array($order->doctor_id, $hospitalDoctors)) {
            if (checkCanStartWork($order->id)) {
                $msg = trans('cruds.booking_change_statusـto_in_progress', ['booking_status' => OrderStatusByName()['inProgress'], 'order_id' => $order->order_id]);
                $title = trans('global.update_order_status');

                dispatch(new SendTaqnyatSms($msg, $order->ownerPatient->getFullPhone()));
                dispatch(new SendFcmNotificationOrder($order->ownerPatient, $title, $msg,$order));

                $order->status = OrderStatus()['inProgress'];
                $order->update();
                return response()->json(['status' => true, 'msg' => trans('global.the_request_has_now_been_executed')]);
            } else {
                return response()->json(['status' => false, 'msg' => trans('global.cant_start_work_order_now')]);
            }

        } else {
            return response()->json(['status' => false, 'msg' => trans('global.cant_')]);
        }
    }


    public function orderChangeBookingDateTrait($request)
    {
        $d = \Carbon\Carbon::parse($request->booking_date);
        $dayOfWeek = $d->locale('en')->dayName;
        $dat = $d->format('Y-m-d');
        $hour = $d->format('H:i');
        $orderId = $request->orderId;
        $hospitalId = auth()->user()->id;

        //update order
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        $order = Order::query()->whereCanChangeBookingTime()->find($orderId);

        if (!$order) {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_this_order_not_found')]);
        }

        if ($order->hospital_id == $hospitalId || in_array($order->doctor_id, $hospitalDoctors)) {

            $order->booking_date = $dat;
            $order->booking_day_en = $dayOfWeek;
            $order->booking_hour = $hour;
            $order->save();
            $order = Order::query()->find($order->id);

            //send notification to patient
            $this->sendFcmAndSmsWhenChangedBookingTime($order);

            return response()->json(['status' => true, 'msg' => trans('global.change_booking_time_successfully')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.cant_change_booking_time')]);
        }
    }


    public function sendFcmAndSmsWhenChangedBookingTime($order)
    {
        /*********************** Start Send Notification & Sms ***************************/
        $ownerPatient = $order->ownerPatient;
        $hospitalInfo = $order->getHospitalInformation();
        $bookingHour = $order->booking_hour;
        $bookingDate = $order->booking_date;
        $hospitalAddress = $order->getHospitalInformation()->hospitalLocation->location;
        $hospitalPhone = $order->getHospitalInformation()->getFullPhone();
        $booking_number = $order->order_id;


        $msgForPatient = trans('cruds.patient_change_booking_time', ['patient_name' => $ownerPatient->getPatientFullName(), 'hospitalName' => $hospitalInfo->getProviderName(), 'booking_number' => $booking_number, 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'hospital_address' => $hospitalAddress, 'hospital_phone' => $hospitalPhone]);
        $msgForHospital = trans('cruds.hospital_change_booking_time', ['patient_name' => $ownerPatient->getPatientFullName(), 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'booking_number' => $booking_number, 'owner_patient_number' => $ownerPatient->getFullPhone()]);
        $title = trans('global.change_booking_time');


        dispatch(new SendTaqnyatSms($msgForPatient, $ownerPatient->getFullPhone())); //send sms to owner patient
        dispatch(new SendFcmNotificationOrder($ownerPatient, $title, $msgForPatient, $order)); //send fcm to owner patient

        if ($order->hospital_id) {
            dispatch(new SendTaqnyatSms($msgForHospital, $hospitalInfo->getFullPhone())); //send sms to hospital
        }
        dispatch(new SendTaqnyatSms($msgForPatient, getHakeemPhone())); //send sms to hakeem phone manager

        /*********************** End Send Notification & Sms ***************************/
    }


    public function acceptOrderTrait($orderId)
    {
        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        $order = Order::query()->findOrFail($orderId);
        if ($order->hospital_id == $hospitalId || in_array($order->doctor_id, $hospitalDoctors)) {
            if ($order->status == OrderStatus()['awaitingAccept']) {

                //if order payment type online payment
                if ($order->payment_type == paymentTypeByName()['PaymentOnline']) {
                    if ($order->total <= 0) {
                        $order->updateQuietly(['status' => OrderStatus()['awaitingImplementation']]);
                        $status = OrderStatusByName()['awaitingImplementation'];
                    } else {
                        $order->updateQuietly(['status' => OrderStatus()['awaitingPayment']]);
                        $status = OrderStatusByName()['awaitingPayment'];
                    }
                } elseif ($order->payment_type == paymentTypeByName()['PayByHand']) {
                    $order->updateQuietly(['status' => OrderStatus()['awaitingImplementation']]);
                    $status = OrderStatusByName()['awaitingImplementation'];
                }

                //if order payment pay by hand must be status is waiting implementation

                $msg = trans('cruds.booking_change_statusـto_accepted', ['booking_status' => $status, 'order_id' => $order->order_id ,'booking_date'=>$order->booking_date,'booking_hour'=>$order->booking_hour]);
                $title = trans('global.update_order_status');

                dispatch(new SendTaqnyatSms($msg, $order->ownerPatient->getFullPhone()));
                dispatch(new SendFcmNotificationOrder($order->ownerPatient, $title, $msg,$order));

                return response()->json(['status' => true, 'msg' => trans('global.orderAccepted')]);
            } else {
                return response()->json(['status' => false, 'msg' => trans('global.orderCantAcceptNow')]);
            }

        } else {
            return response()->json(['status' => false, 'msg' => trans('global.orderCantAcceptNow')]);
        }


    }

    public function completeOrderTrait($orderId)
    {
        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        $order = Order::query()->findOrFail($orderId);
        if ($order->hospital_id == $hospitalId || in_array($order->doctor_id, $hospitalDoctors)) {
            if ($order->status == OrderStatus()['inProgress']) {

                //check order payment type in center or online payment
                if ($order->payment_type == paymentTypeByName()['PayByHand']) {
                    //when use pay by hand must append data in order payment table

                    OrderPayment::query()->create([
                        'order_id' => $order['id'],
                        'payment_reference' => null, //must be nullable
                        'status_transaction' => 'success',
                        'reference_no' => null,//must be nullable
                        'transaction_id' => null,
                        'category_payment' => null,
                        'amount' => $order['total'],
                        'currency' => 'SAR',
                        'order_payment_type' => paymentTypeByName()['PayByHand'],
                    ]);
                }

                $msg = trans('cruds.booking_change_statusـto_completed', ['booking_status' =>  OrderStatusByName()['completed'], 'order_id' => $order->order_id]);
                $title = trans('global.update_order_status');

                dispatch(new SendTaqnyatSms($msg, $order->ownerPatient->getFullPhone()));
                dispatch(new SendFcmNotificationOrder($order->ownerPatient, $title, $msg,$order));

                $order->status = OrderStatus()['completed'];
                $order->update();
                return response()->json(['status' => true, 'msg' => trans('global.orderCompleted')]);
            } else {
                return response()->json(['status' => false, 'msg' => trans('global.orderCantCompletedNow')]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.orderCantCompletedNow')]);
        }
    }

    public function rejectOrderTrait($orderId, $request)
    {
        $hospitalId = auth()->user()->id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();

        $order = Order::query()->findOrFail($orderId);
        if ($order->hospital_id == $hospitalId || in_array($order->doctor_id, $hospitalDoctors)) {
            if (in_array($order->status, [OrderStatus()['awaitingAccept'], OrderStatus()['awaitingPayment'], OrderStatus()['awaitingImplementation'],OrderStatus()['inProgress']])) {
                DB::beginTransaction();
                $rejectReason= RejectReason::query()->find($request->rejectReasonId);

                if ($request->rejectReasonId == 1) {
                    //write other reason
                    $data=   [
                        'ar' => [
                            "description" => $request->rejectReasonAr
                        ],
                        'en' => [
                            "description" => $request->rejectReasonEn
                        ],
                        'order_id' => $order->id,
                    ];

                }else{
                    //select custom reason

                    $data=   [
                        'ar' => [
                            "description" => $rejectReason->translate('ar')->description
                        ],
                        'en' => [
                            "description" => $rejectReason->translate('en')->description
                        ],
                        'order_id' => $order->id,
                    ];
                }
                $rejectReason = RejectReasonOrder::query()->create($data);

                $order->status = OrderStatus()['rejected'];
                $order->update();
                DB::commit();

                $order = Order::query()->find($order->id);
                /*********************** Start Send Notification & Sms ***************************/
                $this->sendFcmAndSms($order, $rejectReason);
                /*********************** End Send Notification & Sms ***************************/


                return response()->json(['status' => true, 'msg' => trans('global.orderRejected')]);
            } else {
                return response()->json(['status' => false, 'msg' => trans('global.orderCantRejected')]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.orderCantRejected')]);
        }
    }

    static function sendFcmAndSms($order, $rejectReason)
    {
        /*********************** Start Send Notification & Sms ***************************/
        $ownerPatient = $order->ownerPatient;
        $hospitalInfo = $order->getHospitalInformation();
        $bookingHour = $order->booking_hour;
        $bookingDate = $order->booking_date;
        $hospitalAddress = $order->getHospitalInformation()->hospitalLocation->location;
        $hospitalPhone = $order->getHospitalInformation()->getFullPhone();
        $booking_number = $order->order_id;
        $msgForPatient = trans('cruds.by_admin_cancel_order_sent_to_patient', ['hospital_name' => $hospitalInfo->getProviderName(), 'patient_name' => $ownerPatient->getPatientFullName(), 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'hospital_address' => $hospitalAddress, 'hospital_phone' => $hospitalPhone, 'reject_reason' => $rejectReason->description]);
        $msgForHospital = trans('cruds.by_admin_cancel_order_sent_to_hospital', ['patient_name' => $ownerPatient->getPatientFullName(), 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'booking_number' => $booking_number, 'owner_patient_phone' => $ownerPatient->getFullPhone(), 'reject_reason' => $rejectReason->description]);

        $title = trans('global.new_order');

        dispatch(new SendTaqnyatSms($msgForPatient, $ownerPatient->getFullPhone())); //send sms to owner patient
        dispatch(new SendFcmNotificationOrder($ownerPatient, $title, $msgForPatient, $order)); //send fcm to owner patient

        if ($order->hospital_id) {
            //send notification to lab
            dispatch(new SendTaqnyatSms($msgForHospital, $hospitalInfo->getFullPhone())); //send sms to hospital
        }
        dispatch(new SendTaqnyatSms($msgForPatient, getHakeemPhone())); //send sms to hakeem phone manager
        /*********************** End Send Notification & Sms ***************************/
    }

    public function orderAssignDoctorTrait($request)
    {
        $hospitalId = auth()->user()->id;
        $orderId = $request->order_id;
        $doctorId = $request->doctor_id;
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();

        $order = Order::query()->findOrFail($orderId);
        if ($order->hospital_id == $hospitalId || in_array($doctorId, $hospitalDoctors)) {
            if (in_array($order->status, [OrderStatus()['awaitingAccept'], OrderStatus()['awaitingPayment']])) {
                $order->doctor_id = $doctorId;
                $order->update();
                return response()->json(['status' => true, 'msg' => trans('global.assign_doctor_successfully')]);
            } else {
                return response()->json(['status' => false, 'msg' => trans('global.cant_assign_doctor')]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.cant_assign_doctor')]);
        }
    }
}
