<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreOrderRequest;
use App\Jobs\SendFcmNotificationOrder;
use App\Jobs\SendTaqnyatSms;
use App\Models\Address;
use App\Models\HospitalServices;
use App\Models\MainService;
use App\Models\Order;
use App\Models\OrderAttachment;
use App\Models\OrderServices;
use App\Models\Service;
use App\Models\User;
use App\Traits\OrderTrait;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use OrderTrait;

    public function index(Request $request)
    {
        $orderStatus = $request->orderStatus;
        $data['orders'] = Order::query()
            ->when($orderStatus, function ($qq) use ($orderStatus) {
                return $qq->where('status', $orderStatus);
            })->where('owner_patient_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('patient.orders.index', $data);
    }

    public function show($orderId)
    {
        $data['order'] = Order::query()->where('owner_patient_id', auth()->user()->id)->findOrFail($orderId);

        if ($data['order']) {
            return view('patient.orders.show', $data);
        } else {
            return redirect()->route('patient.orders.index');
        }
    }

    public function store(StoreOrderRequest $request)
    {

        DB::beginTransaction();

        $auth = auth()->user();
        $main_service_id = mainServiceById()['Lab'];
        $lab_id = $request->lab_id;
        $booking_date = $request->booking_date;
        $booking_hour = $request->booking_hour;
        $service = $request->service_id;


        $status = OrderStatus()['awaitingAccept'];
        $lab = User::query()->whereLab()->hospitalWorkMainServices($main_service_id)->find($lab_id);
        if ($lab) {
            $lab_service_id = $lab->hospitalServices->pluck('pivot.service_id')->toArray();

            $in_array = in_array($service, $lab_service_id);
            if (!$in_array) {
                // check this  hospital  provide the same service selected by the patient
                return response()->json(['status' => false, 'msg' => trans('global.sorry_this_hospital_not_provide_all_services_selected')]);

            }
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_not_fount_this_hospital')]);
        }

        //check if doctor work in this booking day and date and hours
        $booking_day_en = Carbon::parse($booking_date)->locale('en')->dayName;

        $checkDoctorWorkInTime = CheckHospitalWorkInMainServiceTime($lab_id, $main_service_id, $booking_date, $booking_day_en, $booking_hour);
//            return sendError("$lab_id, $main_service_id, $booking_date, $booking_day_en, $booking_hour", [null]);
        if ($checkDoctorWorkInTime['status'] == false) {
            return sendError($checkDoctorWorkInTime['msg'], [null]);
        }

        $checkHospitalIsFree = Order::query()->checkHospitalHasReservationMainService($lab_id, $main_service_id,
            $booking_date, $booking_day_en, $booking_hour)->first();
        if ($checkHospitalIsFree) {
            return sendError(trans('global.sorry_this_hospital_is_busy_at_this_time'), [null]);
        }


        $order = Order::query()->updateOrCreate([
            'doctor_id' => null, // this order reference to hospital
            'patient_id' => $auth->id,
            'hospital_id' => $lab_id,
            'main_service_id' => $main_service_id,
            'booking_date' => $booking_date,
            'booking_day_en' => $booking_day_en,
            'booking_hour' => $booking_hour,
            'address_id' => $request->address_id,
            'sub_total' => totalPriceServices($lab_id, $service), //get total  Prices for hospital services
            'status' => $status,
            'order_type' => order_type()['GoHospital'],
            'use_insurance' => 0,
            'insurance_company_id' => null,
            'payment_type' => paymentTypeByName()['PaymentOnline'],
        ]);
        $this->addAttachmentOrder($order, $request);
        $this->calculateFinancialOrder($order);
        $this->orderServices($order, $service);
        //save  in order_services
        $order = Order::query()->find($order->id);
        /*********************** Start Send Notification & Sms ***************************/
        $this->sendOrderFcmAndSms($order);
        /*********************** End Send Notification & Sms ***************************/

        DB::commit();
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);

        return response()->json(['status' => true, 'msg' => trans('global.create_order_successfully_must_pay_now')]);


    }

    public function orderServices($order, $service)
    {
        OrderServices::query()->updateOrCreate(
            [
                'order_id' => $order->id,
                'service_id' => $service,
                'price' => HospitalServices::query()->servicesPriceHospital($order->hospital_id, $service),
            ]
        );

    }

    public function calculateFinancialOrder($order)
    {
        $vat = calculateVat(auth()->user()->id, $order->id);
        $orderSubTotal = $order->sub_total;
        if ($vat == 0) {
            $total = $orderSubTotal;
        } else {
            $total = $orderSubTotal * ($vat / 100) + $orderSubTotal;
        }

        Order::query()->find($order->id)->update([
            'vat' => $vat,
            'vat_value' => $vat * ($orderSubTotal / 100),
            'total' => $total,
        ]);
    }

    public function addAttachmentOrder($order, $request)
    {
        $order = Order::query()->find($order->id);

        $voice_file = null;
        if ($request->has('voice')) {
            $voice_file = uniqid() . '.' . $request->voice->guessExtension();
            $request->file('voice')->storeAs('public/orders', $voice_file);
        }

        $attachment_file = null;
        if ($request->has('attachment_file')) {
            $attachment_file = uniqid() . '.' . $request->attachment_file->guessExtension();
            $request->file('attachment_file')->storeAs('public/orders', $attachment_file);
        }

        $data = [
            'order_id' => $order->id,
            'comment' => $request->comment,
            'voice' => $voice_file,
            'attachment_file' => $attachment_file,
        ];
        $checkOrderAttachment = OrderAttachment::query()->where('order_id', $order->id)->first();
        if ($checkOrderAttachment) {
            $checkOrderAttachment->update($data);
        } else {
            OrderAttachment::query()->create($data);
        }

    }

    public function create()
    {
        $data['services'] = Service::query()->get();
        $data['labs'] = User::query()->WhereLab()->orderBy('id', 'DESC')->get();
        $data['labs'] = User::query()->WhereLab()->orderBy('id', 'DESC')->get();
        $data['address'] = Address::query()->where('user_id', auth()->user()->id)->get();
        return view('patient.orders.create', $data);
    }

    public function hospitalDivisionHourScheduleMainService($labId)
    {
        $labHourScheduleMainService = hospitalDivisionHourScheduleMainService($labId, mainServiceById()['Lab']);
        if ( empty($labHourScheduleMainService) ) {
            return response()->json(['status' => false, 'msg' => 'Note: Sorry, the medical laboratory has not set the work schedule yet (all working days are closed for this laboratory)']);
        } else {
            return response()->json(['status' => true, 'labs' => $labHourScheduleMainService]);

        }
    }

    public function getLabsByService($serviceId)
    {
        $mainService = MainService::query()->find(mainServiceById()['Lab']);
        $canWorkOutside = 1;
        $labs = User::query()->wherelab()
            ->HospitalWorkMainServicesValidation($mainService, $canWorkOutside)
            ->whereHas('hospitalServices')->get();

        $selectLabs = [];
        foreach ($labs as $lab) {
            $lab_service_id = $lab->hospitalServices->pluck('pivot.service_id')->toArray();
            $array = array_diff([$serviceId], $lab_service_id);
            if ($array == null) {
                //get  all lab that provide the same service selected by the patient
                $selectLabs[] = $lab->id;
            }
        }

        $labs = User::query()->whereIn('id', $selectLabs)
            ->get(['id', 'photo', 'provider_name_ar', 'provider_name_en'])
            ->append('lab_name'); // 'provider_name' is the accessor name.;

        if ($labs->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'No labs found for this service.']);
        }

        return response()->json(['status' => true, 'labs' => $labs]);
    }


    static function sendOrderFcmAndSms($order)
    {
        /*********************** Start Send Notification & Sms ***************************/
        $ownerPatient = $order->ownerPatient;
        $hospitalInfo = $order->getHospitalInformation();
        $bookingHour = $order->booking_hour;
        $bookingDate = $order->booking_date;
        $hospitalAddress = $order->getHospitalInformation()->hospitalLocation->location;
        $hospitalPhone = $order->getHospitalInformation()->getFullPhone();
        $booking_number = $order->order_id;
        $msgForPatient = trans('cruds.patient_add_new_order_to_lab_service', ['labName' => $hospitalInfo->getProviderName(), 'patient_name' => $ownerPatient->getPatientFullName(), 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'lab_address' => $hospitalAddress, 'lab_phone' => $hospitalPhone]);
        $msgForHospital = trans('cruds.lab_add_new_order_to_lab_service', ['patient_name' => $ownerPatient->getPatientFullName(), 'booking_date' => $bookingDate, 'booking_hour' => $bookingHour, 'booking_number' => $booking_number, 'owner_patient_phone' => $ownerPatient->getFullPhone()]);
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



}
