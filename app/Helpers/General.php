<?php

use App\Models\HospitalMainService;
use App\Models\InsuranceHospitalMainService;
use App\Models\Notification as NotificationSystem;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\ScheduleHourInHospital;
use App\Models\ScheduleInHospital;
use App\Models\ScheduleMainServicesHospital;
use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\WorkScheduleHours;
use App\Services\FirebaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

function get_default_lang()
{
    return App::getLocale();
}

function numberFormat($number)
{
    return (float)number_format($number, 3);
}

function checkWalletBalanceEnough($amount): bool
{
    return auth()->user()->walletPatient->amount >= $amount;
}

function hospitalMainServiceLocations($hospitalMainServiceLocations)
{

    $locations = '';
    $iterateNumber = 0;
    if (count($hospitalMainServiceLocations) != 0) {
        foreach ($hospitalMainServiceLocations as $index => $value) {
            $iterateNumber++;
            $check = $iterateNumber == count($hospitalMainServiceLocations) ? '' : ',';
            $locations = $locations . "{lat:$value->lat , lng:  $value->lng}$check";
        }
    } else {
        //this default locations
        $locations = "{lat: 25.04100727451999, lng: 48.17362707031248},{lat: 25.911241453461287, lng: 46.36921714135743},{lat: 25.942499771443867, lng: 46.25964091564945},{lat: 24.317966550335626, lng: 45.85343383056642}";
    }

    return $locations;
}

function zoomHospitalMainServiceLocations($mainServiceId)
{
//    get first location polygon
    $hospital_id = auth()->user()->id;
    $location = \App\Models\HospitalMainServiceLocations::query()->whereHospitalMainService($hospital_id, $mainServiceId)->first();
    if ($location) {
        return "{lat:$location->lat , lng:  $location->lng}";

    } else {
        //this default locations
        return "{lat:25.04100727451999, lng: 48.17362707031248}";
    }

}

function checkPermission($permissionName)
{
    $allRoles = auth()->user()->roles;
    foreach ($allRoles as $data) {
        foreach ($data->permissions as $item) {
            if ($item->title == $permissionName)
                return true;
        }
    }
}

function settingContent($key)
{
    $Setting = \App\Models\Setting::query()->where('key', $key)->first();
    if (!$Setting) {
        return "";
    } else {
        return $Setting->value;
    }
}

function getHakeemPhone()
{
    $hakeemPhone = \App\Models\Setting::query()->where('key', 'mobile')->first();
    if (!$hakeemPhone) {
        return "966531135214";
    } else {
        return "966" . $hakeemPhone->value;
    }
}

function editContent($key, $lang)
{
    if (in_array($lang, ['ar', 'en'])) {
        $Setting = \App\Models\Setting::query()->where('key', $key)->first();
        if (!$Setting) {
            return "";
        } else {
            return $Setting->translate($lang)->value;
        }
    } else {
        return 'language not found';
    }

}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return $filename;
}

function profitAmount($month)
{
    return OrderPayment::query()->whereMonth('created_at', $month)->sum('amount');
}

function profitAmountForHospital($month)
{
    $hospital_id = auth()->user()->id;
    return \App\Models\OrderPayment::query()->whereHas('order', function ($order) use ($hospital_id) {
        $order->where('hospital_id', $hospital_id);
    })->whereMonth('created_at', $month)->sum('amount');
}

function sendResponse($result, $message)
{

//    $code = $result->count() == 0 ? 204 : 200;
    $response = [
        'code' => 200,
        'success' => true,
        'message' => $message,
        'data' => $result
    ];
    return response()->json($response, 200);
}

function sendError($error, $errorMessages = [], $code = 400)
{
    $response = [
        'code' => 400,
        'success' => false,
        'message' => $error,
        'data' => null,
    ];
    return response()->json($response, $code);
}

function sendErrorNotAuth($error, $errorMessages = [], $code = 401): \Illuminate\Http\JsonResponse
{
    $response = [
        'code' => 401,
        'success' => false,
        'message' => $error,
        'data' => null,
    ];
    return response()->json($response, $code);
}

function sendErrorNotVerify($error, $errorMessages = [], $code = 401): \Illuminate\Http\JsonResponse
{
    $response = [
        'code' => 410,
        'success' => false,
        'message' => $error,
        'data' => null,
    ];
//    if (!empty($errorMessages)) {
//        $response['data'] = null;
//    }
    return response()->json($response, $code);

}

function divisionHour($hours): array
{
    $allHours = [];
    foreach ($hours as $hour) {
        if ($hour == 24) {
//            the next hour
            $nextHour = "1";
            $hour = "00";
        } else {
            $nextHour = $hour + 1;
            if ($nextHour == 24) {
                $nextHour = "00";
            }

        }
//        $allHours [] = [$hour . ":15", $hour . ":30", $hour . ":45", "$nextHour".":00"];
        array_push($allHours, $hour . ":15");
        array_push($allHours, $hour . ":30");
        array_push($allHours, $hour . ":45");
        array_push($allHours, "$nextHour" . ":00");
    }
    return $allHours;
}

function divisionHourInsideHospital($hours): array
{
    $allHours = [];
    foreach ($hours as $hour) {
        if ($hour == 24) {
//            the next hour
            $nextHour = "1";
            $hour = "00";
        } else {
            $nextHour = $hour + 1;
            if ($nextHour == 24) {
                $nextHour = "00";
            }
        }

//        $allHours [] = [$hour . ":15", $hour . ":30", $hour . ":45", "$nextHour".":00"];
        array_push($allHours, $hour . ":15");
        array_push($allHours, $hour . ":30");
        array_push($allHours, $hour . ":45");
        array_push($allHours, "$nextHour" . ":00");
    }
    return $allHours;
}

function sortHourTime($allHours): array
{


// Convert the time strings to timestamps and sort them
    $timestamps = array_map(function ($time) {
        return strtotime($time);
    }, $allHours);
    sort($timestamps);

// Convert the timestamps back to time strings
    $sortedTimes = array_map(function ($timestamp) {
        return date('H:i', $timestamp);
    }, $timestamps);

// Output the sorted array
    return $sortedTimes;
}

function staticHorses(): array
{
    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
}

function staticDays(): array
{
    return ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
}

function checkWorkInsideOrOutSide($main_service_id, $request_check_inside_hospital)
{
    if (in_array($main_service_id, [mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic'], mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare']])) {
        //all this services work outside hospital cant work inside hospital
        return placeServiceProvided()['out_side_hospital'];
    } else {
        return $request_check_inside_hospital; //maybe this value returned 0 ('outside') or 1 ('inside') based on the user's choice from the application.
    }
}

function checkInsuranceSupport($main_service_id, $can_work_outside)
{
    if (in_array($main_service_id, [mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic'], mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare']])) {
        //all this services work outside hospital cant work inside hospital
        return [InsuranceHospitalMainService::PlaceServiceProvided['supported_out_side'], InsuranceHospitalMainService::PlaceServiceProvided['supported_in_side_and_out_side']];
    } else {
        if ($can_work_outside == 1) {
            //inside hospital
            return [InsuranceHospitalMainService::PlaceServiceProvided['supported_in_side'], InsuranceHospitalMainService::PlaceServiceProvided['supported_in_side_and_out_side']];
        } else {
            //outside hospital
            return [InsuranceHospitalMainService::PlaceServiceProvided['supported_out_side'], InsuranceHospitalMainService::PlaceServiceProvided['supported_in_side_and_out_side']];
        }
    }
}

function order_type(): array
{
    return [
        'HomeVisit' => 1,
        'GoHospital' => 2,
        'Online' => 3,
    ];
}

function orderProvideCount($orderStatus)
{
    $hospitalId = auth()->user()->id;
    $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();

    return Order::query()
        ->when($orderStatus, function ($qq) use ($orderStatus) {
            return $qq->where('status', $orderStatus);
        })
        ->where(function ($query) use ($hospitalDoctors, $hospitalId) {
            $query->whereIn('doctor_id', $hospitalDoctors)
                ->orWhere('hospital_id', $hospitalId);
        })
        ->orderBy('id', 'DESC')
        ->count();
}
function orderPatientCount($orderStatus)
{

    return Order::query()
        ->when($orderStatus, function ($qq) use ($orderStatus) {
            return $qq->where('status', $orderStatus);
        })->where('owner_patient_id',auth()->user()->id)
         ->count();
}
function orderCount($orderStatus)
{
    return Order::query()
        ->when($orderStatus, function ($qq) use ($orderStatus) {
            return $qq->where('status', $orderStatus);
        })
        ->orderBy('id', 'DESC')
        ->count();
}

function order_type_by_number(): array
{
    return [
        '1' => 'HomeVisit',
        '2' => 'GoHospital',
        '3' => 'Online',
    ];
}

function order_type_translate_by_number(): array
{
    return [
        '1' => trans('global.home_visit'),
        '2' => trans('global.go_hospital'),
        '3' => trans('global.online'),
    ];
}

function OrderStatus(): array
{
    return [
        'awaitingAccept' => 1, // Awaiting Accept From Hospital
        'awaitingPayment' => 2,
        'awaitingImplementation' => 3,
        'inProgress' => 4,
        'completed' => 5,
        'rejected' => 6,
        'cancel' => 7,
    ];
}

function colorsOrderStatus(): array
{
    return [
        1 => '0xFFFECA43',
        2 => '0xFF437DFE',
        3 => '0xFFDF57DA',
        4 => '0xFF69DF57',
        5 => '0xFF7E53FD',
        6 => '0xFFFE6243',
        7 => '0xFFFE6243',
    ];
}

function OrderStatusByNumber(): array
{
    return [
        1 => trans('global.awaitingAccept'), // Awaiting Accept From Hospital
        2 => trans('global.awaitingPayment'),
        3 => trans('global.awaitingImplementation'),
        4 => trans('global.inProgress'),
        5 => trans('global.completed'), //green
        6 => trans('global.rejected'),
        7 => trans('global.cancel'),
    ];
}
function OrderStatusByNumber_Web(): array
{
    return [
        1 => trans('global.awaitingAccept'), // Awaiting Accept From Hospital
        2 => trans('global.awaitingPayment'),
        3 => trans('global.awaitingImplementation'),
        4 => trans('global.inProgress'),
        5 => trans('global.completed'), //green
        6 => trans('global.rejected'),
        7 => trans('global.cancel'),
    ];
}

function OrderStatusByName(): array
{
    return [
        'awaitingAccept' => trans('global.awaitingAccept'), // Awaiting Accept From Hospital
        'awaitingPayment' => trans('global.awaitingPayment'),
        'awaitingImplementation' => trans('global.awaitingImplementation'),
        'inProgress' => trans('global.inProgress'),
        'completed' => trans('global.completed'), //green
        'rejected' => trans('global.rejected'),
        'cancel' => trans('global.cancel'),
    ];
}

function doctorDivisionHourScheduleOutsideHospital($doctorId, $mainServiceId)
{
    /***** Function: get doctor Division Hour Schedule Outside Hospital (home visit) ***********/
    $current_month = Carbon::now()->format('Y-m');
    $start = Carbon::parse($current_month)->startOfMonth();
    $end = Carbon::parse($current_month)->endOfMonth();
    $current_date = Carbon::now()->format('Y-m-d');

    $dates = [];
    while ($start->lte($end)) {
        $dates[] = (object)['date' => Carbon::parse($start)->format('Y-m-d'), 'day' => Carbon::parse($start)->locale('en')->dayName];
        $start->addDay();
    }
    //get date name from schedule doctor
    $myActiveSchedule = WorkSchedule::query()->doctorActiveSchedule($doctorId)->pluck('day_name')->toArray();
    $daySelect = collect($dates)->whereIn('day', $myActiveSchedule)->where('date', '>=', $current_date);

    $findHospitalId = \App\Models\User::query()->find($doctorId)->doctorSetting->hospital_id;

    /*****  find The hospital accepts the order before this time ****/
    $time_before_receiving = HospitalMainService::query()->HospitalHasMainService($findHospitalId, $mainServiceId)->first()->time_before_receiving;
    /***** The hospital accepts the order before this time ****/
    $carbon_now = Carbon::now()->format('Y-m-d H:i');
    $workPart = [];
    $availableHour = [];

    foreach ($daySelect as $day) {
        $hours = WorkScheduleHours::query()->DoctorHoursWorkWhereDay($day->day, $doctorId)->pluck('hour')->toArray();
        $availableHour = [];
        foreach (divisionHour($hours) as $hh) {

            $actual_start_at = Carbon::parse($day->date . ' ' . $hh);

            $time1 = Carbon::parse($actual_start_at);
            $time2 = Carbon::parse($carbon_now);

            $differenceInMinutes = $time2->diffInMinutes($time1);

            if ($differenceInMinutes >= $time_before_receiving && $time1 > $time2) {
                $availableHour[] = $hh;
            }
        }
        $workPart[] = ['label' => trans("global.$day->day") . ' ' . Carbon::parse($day->date)->format('d/m'), 'date' => $day->date, 'day' => $day->day, 'hours' => $availableHour];
    }

    return $workPart;
}

function doctorDivisionHourScheduleInsideHospital($doctorId, $mainServicesId): array
{

    /***** Function: get doctor Division Hour Schedule Inside Hospital  (work inside hospital) ***********/
    $current_month = Carbon::now()->format('Y-m');
    $start = Carbon::parse($current_month)->startOfMonth();
    $end = Carbon::parse($current_month)->endOfMonth();
    $current_date = Carbon::now()->format('Y-m-d');

    $dates = [];
    while ($start->lte($end)) {
        $dates[] = (object)['date' => Carbon::parse($start)->format('Y-m-d'), 'day' => Carbon::parse($start)->locale('en')->dayName];
        $start->addDay();
    }
    //get date name from schedule doctor
    $myActiveSchedule = ScheduleInHospital::query()->doctorActiveSchedule($doctorId)->pluck('day_name')->toArray();
    $daySelect = collect($dates)->whereIn('day', $myActiveSchedule)->where('date', '>=', $current_date);


    $findHospitalId = \App\Models\User::query()->find($doctorId)->doctorSetting->hospital_id;
    /*****  find The hospital accepts the order before this time ****/
    $time_before_receiving = HospitalMainService::query()->HospitalHasMainService($findHospitalId, $mainServicesId)->first()->time_before_receiving;
    /***** The hospital accepts the order before this time ****/
    $carbon_now = Carbon::now()->format('Y-m-d H:i');

    $workPart = [];
    $availableHour = [];

    foreach ($daySelect as $day) {
        $hours = ScheduleHourInHospital::query()->DoctorHoursWorkWhereDay($day->day, $doctorId)->pluck('hour')->toArray();
        $availableHour = [];
        foreach (divisionHourInsideHospital($hours) as $hh) {
            $actual_start_at = Carbon::parse($day->date . ' ' . $hh);

            $time1 = Carbon::parse($actual_start_at);
            $time2 = Carbon::parse($carbon_now);

            $differenceInMinutes = $time2->diffInMinutes($time1);

            if ($differenceInMinutes >= $time_before_receiving && $time1 > $time2) {
                $availableHour[] = $hh;
            }
        }
        $workPart[] = ['label' => trans("global.$day->day") . ' ' . Carbon::parse($day->date)->format('d/m'), 'date' => $day->date, 'day' => $day->day, 'hours' => $availableHour];

    }


    return $workPart;
}

function hospitalDivisionHourScheduleMainService($hospitalId, $mainServicesId)
{
    /** Function: get doctor Division Hour Schedule Outside Hospital (home visit) ****/
    $current_month = Carbon::now()->format('Y-m');
    $start = Carbon::parse($current_month)->startOfMonth();
    $end = Carbon::parse($current_month)->endOfMonth();
    $current_date = Carbon::now()->format('Y-m-d');

    $dates = [];
    while ($start->lte($end)) {
        $dates[] = (object)['date' => Carbon::parse($start)->format('Y-m-d'), 'day' => Carbon::parse($start)->locale('en')->dayName];
        $start->addDay();
    }
    //get date name from schedule doctor
    $myActiveSchedule = \App\Models\ScheduleMainServicesHospital::query()->whereNull('deleted_at')->hospitalMainServiceActiveSchedule($hospitalId, $mainServicesId)->pluck('day_name')->toArray();
    $daySelect = collect($dates)->whereIn('day', $myActiveSchedule)->where('date', '>=', $current_date);

    /*****  find The hospital accepts the order before this time ****/

    $time_before_receiving = HospitalMainService::query()->HospitalHasMainService($hospitalId, $mainServicesId)->first()->time_before_receiving;
    /***** The hospital accepts the order before this time ****/

    $carbon_now = Carbon::now()->format('Y-m-d H:i');
    $workPart = [];
    $availableHour = [];
    foreach ($daySelect as $day) {
        $hours = \App\Models\ScheduleHourMainServicesHospital::query()->whereNull('deleted_at')->hospitalMainServiceHoursWorkWhereDay($day->day, $hospitalId, $mainServicesId)->pluck('hour')->toArray();
        $availableHour = [];
        foreach (divisionHour($hours) as $hh) {
            $actual_start_at = Carbon::parse($day->date . ' ' . $hh);
            $workingHours = ((strtotime($actual_start_at) - strtotime($carbon_now)) / 3600) * 60; //the result by minute
            if ($workingHours >= $time_before_receiving) {
                $availableHour[] = $hh;
            }
        }
//        $workPart[] = ['date' => $day->date, 'day' => $day->day, 'hours' => $availableHour];
        $workPart[] = ['label' => trans("global.$day->day") . ' ' . Carbon::parse($day->date)->format('d/m'), 'date' => $day->date, 'day' => $day->day, 'hours' => $availableHour];

    }
    return $workPart;
}


function calculateVat($patientId, $orderId): int
{
    $patient = \App\Models\User::query()->findOrFail($patientId);
    $order = Order::query()->findOrFail($orderId);

    if ($order && $patient) {


             $user = User::query()->find($order->patient_id);

        $nationalityCode = $user->country->iso2;

        //delete any space from string
        $passport_id = preg_replace('/\s+/', '', $patient->passport_id);
        $checkPassportSaudi = substr($passport_id, 0, 1);

        //Check Passport start with 1
        if ($checkPassportSaudi == "1" && $nationalityCode == "SA") {
            return 0;
        } else {
            $vat = settingContent('vat');
            return (integer)$vat;
        }
    }
}

function checkVat($request): int
{
    $authPatientId = auth()->user()->id;

    $patient = \App\Models\User::query()->findOrFail($authPatientId);


        $user = User::query()->find($authPatientId);


    $nationalityCode = $user->country->iso2;


    //delete any space from string
    $passport_id = preg_replace('/\s+/', '', $patient->passport_id);
    $checkPassportSaudi = substr($passport_id, 0, 1);

    //Check Passport start with 1
    if ($checkPassportSaudi == "1" && $nationalityCode == "SA") {
        return 0;
    } else {
        $vat = settingContent('vat');
        return (integer)$vat;
    }

}

function CheckDoctorWorkInTimeOutSideHospital($doctor_id, $booking_date, $booking_day_en, $booking_hour, $mainService): array
{
    // This Function : use when want check Doctor work (HomeVisit) or (online)
    $doctorSchedule = doctorDivisionHourScheduleOutsideHospital($doctor_id, $mainService);
    $doctorSchedule = collect($doctorSchedule);
    $checkScheduleDayDate = $doctorSchedule->where('day', $booking_day_en)->where('date', $booking_date)->first();
    $check_hour = "false";
    if ($checkScheduleDayDate) {
        $check_hour = in_array($booking_hour, $checkScheduleDayDate['hours']);
    }
    if ($checkScheduleDayDate && $check_hour == "true") {
        return ['status' => true, 'msg' => 'doctor work in this time'];
    } else {
        return ['status' => false, 'msg' => trans('global.doctor_dont_work_in_this_time')];
    }
}

function CheckDoctorWorkInTimeInsideHospital($doctor_id, $booking_date, $booking_day_en, $booking_hour,$mainService): array
{
    // This Function : use when want check Doctor work (Inside Hospital)
    $doctorSchedule = doctorDivisionHourScheduleInsideHospital($doctor_id,$mainService); //get schedule doctor inside hospital
    $doctorSchedule = collect($doctorSchedule);
    $checkScheduleDayDate = $doctorSchedule->where('day', $booking_day_en)->where('date', $booking_date)->first();
    $check_hour = "false";
    if ($checkScheduleDayDate) {
        $check_hour = in_array($booking_hour, $checkScheduleDayDate['hours']);
    }
    if ($checkScheduleDayDate && $check_hour == "true") {
        return ['status' => true, 'msg' => 'doctor work in this time'];
    } else {
        return ['status' => false, 'msg' => trans('global.doctor_dont_work_in_this_time')];
    }
}

function mainServiceById(): array
{
    return [
        'TeleMedicUrgent' => 1,
        'HomeVisitUrgent' => 2,
        'TeleMedic' => 3,
        'PublicServices' => 4,
        'SupportiveService' => 5,
        'HomeCare' => 6,
        'Lab' => 7,
        'Vitamin' => 8,
        'Nurse' => 9,
        'Radiology' => 10,
        'Caregiver' => 11,
        'Vaccine' => 12,
        'Appointment' => 13,
        'Offer' => 14
    ];
}

function placeServiceProvided(): array
{
    return [
        'out_side_hospital' => 0,
        'inside_hospital' => 1,
        'inside_and_out_side_hospital' => 2,
    ];
}

function mainServiceName(): array
{
    return [
        '1' => 'TeleMedicUrgent',
        '2' => 'HomeVisitUrgent',
        '3' => 'TeleMedic',
        '4' => 'PublicServices',
        '5' => 'SupportiveService',
        '6' => 'HomeCare',
        '7' => 'Lab',
        '8' => 'Vitamin',
        '9' => 'Nurse',
        '10' => 'Radiology',
        '11' => 'Caregiver',
        '12' => 'Vaccine',
        '13' => 'Appointment',
        '14' => 'Offer'
    ];
}

function mainServiceDetails($mainServiceId): array
{
    $mainService = \App\Models\MainService::query()->find($mainServiceId);
    if ($mainService->id == mainServiceById()['TeleMedicUrgent']) {
        // tele medic  &  is urgent  ==> can_work_emergency_online
        return ['status' => 'can_work_emergency_online'];
    } elseif ($mainService->id == mainServiceById()['HomeVisitUrgent']) {
        //urgent  &  home visit (outside hospital) ==> can_work_emergency_home_visit
        return ['status' => 'can_work_emergency_home_visit'];
    } elseif ($mainService->id == mainServiceById()['TeleMedic']) {
        // tele medic & not urgent ==> can_work_online
        return ['status' => 'can_work_online'];
    } elseif ($mainService->id == mainServiceById()['PublicServices']) {
        // not urgent  &  home visit (outside hospital) ==> can_work_in_home_visit
        return ['status' => 'can_work_in_home_visit'];
    } elseif ($mainService->id == mainServiceById()['Appointment']) {
        // not urgent  &  in hospital (inside hospital) ==> can_work_in_hospital
        return ['status' => 'can_work_in_hospital'];
    }

}

function CheckHospitalWorkInMainServiceTime($hospital_id, $main_service_id, $booking_date, $booking_day_en, $booking_hour): array
{
    // This Function : use when want check Doctor work (Inside Hospital)
    $hospitalSchedule = hospitalDivisionHourScheduleMainService($hospital_id, $main_service_id);
    $hospitalSchedule = collect($hospitalSchedule);
    $checkScheduleDayDate = $hospitalSchedule->where('day', $booking_day_en)->where('date', $booking_date)->first();
    $check_hour = "false";
    if ($checkScheduleDayDate) {
        $check_hour = in_array($booking_hour, $checkScheduleDayDate['hours']);
    }
    if ($checkScheduleDayDate && $check_hour == "true") {
        return ['status' => true, 'msg' => 'hospital work in this time successfully'];
    } else {
        return ['status' => false, 'msg' => trans('global.sorry_the_hospital_does_not_supports_this_main_service_at_other_times')];
    }
}

function totalPriceServices($hospitalId, $serviceId)
{
    $total = \App\Models\HospitalServices::query()->where('hospital_id', $hospitalId)->whereIn('service_id', [$serviceId])->sum('price');
    return $total;
}

function send_notification($title, $body, $user, $link = null, $data_backend = null, $data_redirect = null)
{
    $lang = get_default_lang();
    $image = '';
    $platform = $user->platform;
    $data_redirect = is_array($data_redirect) ? $data_redirect : [];
    $data_backend = is_array($data_backend) ? $data_backend : [];

    NotificationSystem::create([
        "ar" => [
            'title' => $title,
            'body' => $body,
        ],
        "en" => [
            'title' => $title,
            'body' => $body,
        ],
        'date' => Carbon::now(),
        'is_read' => 0,
        'data_backend' => "{}",
//        'data_redirect' => json_encode($data_redirect),
        'user_id' => $user->id,
        'link' => $link,
        'platform' => $platform,
        'image' => $image
    ]);
    push_notification_order($user, $title, $body, $platform, $data_backend, $link, $data_redirect);
}

function push_notification_order($user, $title, $body, $platform, $data_backend, $link, $data_redirect, $imageUrl = null)
{
    $data = [
        'click_action' => $link,
        'title' => $title,
        'body' => $body,
//        'data_backend' => json_encode($data_backend),
        'data_redirect' => json_encode($data_redirect),
        'platform' => $platform,
        'user_id' => $user->id,
        'link' => $link,
        'date' => Carbon::now(),
    ];
    FirebaseService::sendNotification((string)$user->fcm_notification, $title, $body,$imageUrl, $data);
}

function push_topic_notification($title, $body, $platform, $imageUrl = null)
{
    $data = [
        'click_action' => null,
        'title' => $title,
        'body' => $body,
        'data_redirect' => null,
        'platform' => $platform,
        'link' => null,
        'date' => Carbon::now(),
    ];
    FirebaseService::sendTopicNotification("news", $title, $body, $imageUrl, $data);
}

function MainServicesHospitalValue($hospitalId, $mainServiceId, $day_name)
{
    //use this function in hospital dashboard

    $myWorkSchedule = ScheduleMainServicesHospital::query()->HospitalMainServiceSchedule($hospitalId, $mainServiceId, $day_name)->first();
    if ($myWorkSchedule) {
        return $myWorkSchedule->active;
    } else {
        return 0;
    }
}

function MainServicesHospitalHouses($hospitalId, $mainServiceId, $day_name)
{
    //use this function in hospital dashboard
    $myWorkSchedule = ScheduleMainServicesHospital::query()->HospitalMainServiceSchedule($hospitalId, $mainServiceId, $day_name)->first();
    if ($myWorkSchedule) {
        return $myWorkSchedule->workScheduleHours->pluck('hour')->toArray();
    } else {
        return [];
    }
}

function checkCanStartWork($orderId)
{
//    $order = Order::query()->where('status', OrderStatus()['awaitingImplementation'])->findOrFail($orderId);
//
//    $orderStartAt = $order->booking_date . ' ' . $order->booking_hour;
//    $start_booking_date = \Illuminate\Support\Carbon::createFromDate($orderStartAt)->subHour(5);
//    $end_booking_last = \Illuminate\Support\Carbon::createFromDate($orderStartAt)->addHour(5);
//    $now = Carbon::now();
//
//    //First Important Note: Hospital You can start working the reservation before five hours the original reservation time
//    //Second Important Note: Hospital You can start working on the reservation a maximum of five hours after the original reservation date
//
//    if ($now->between($start_booking_date, $end_booking_last) && $order->order_type && $order->status == OrderStatus()['awaitingImplementation']) {
//        // can start work
//        return true;
//    } else {
//        //  cant start work
//        return false;
//    }
    return true;
}

function isPointInPolygon($pointLat, $pointLng, $polygon)
{
    $verticesCount = count($polygon);
    $intersectCount = 0;

    for ($i = 1; $i < $verticesCount; $i++) {
        $vertex1 = $polygon[$i - 1];
        $vertex2 = $polygon[$i];

        if (($vertex1['lng'] < $pointLng && $vertex2['lng'] >= $pointLng) ||
            ($vertex2['lng'] < $pointLng && $vertex1['lng'] >= $pointLng)
        ) {
            if ($vertex1['lat'] +
                ($pointLng - $vertex1['lng']) / ($vertex2['lng'] - $vertex1['lng']) *
                ($vertex2['lat'] - $vertex1['lat']) < $pointLat
            ) {
                $intersectCount++;
            }
        }
    }

    return $intersectCount % 2 == 1;


    /**************** simple  example to (isPointInPolygon) **************************************************/
//    $pointLat = 37.7749; // Example point latitude
//    $pointLng = -122.4194; // Example point longitude
//
//    $polygon = [
//        ['lat' => 37.7749, 'lng' => -122.4194], // Example polygon vertex 1
//        ['lat' => 37.7748, 'lng' => -122.4196], // Example polygon vertex 2
//        ['lat' => 37.7747, 'lng' => -122.4192], // Example polygon vertex 3
//        // Add more vertices as needed
//    ];
//
//    $isWithinPolygon = isPointInPolygon($pointLat, $pointLng, $polygon);
//
//    if ($isWithinPolygon) {
//        echo "The point is within the polygon.";
//    } else {
//        echo "The point is outside the polygon.";
//    }
    /**************** simple  example to (isPointInPolygon)  **************************************************/
}

function paymentTypeById(): array
{
    return [
        '0' => 'PaymentOnline',
        '1' => 'PayByHand',
    ];
}
function paymentTypeByName(): array
{
    return [
        'PaymentOnline' => 0,
        'PayByHand' => 1,
    ];
}


function checkMainServiceActive($mainServiceId)
{
    $mainService = \App\Models\MainService::query()->find($mainServiceId);
    if ($mainService->status == 1) {
        return true;
    }
    return false;
}

function checkHospitalHaveMainService($hospitalId, $mainServiceId)
{
    return HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)->first();
}
function checkHospitalMainServiceSupportB2B($hospitalId, $mainServiceId)
{
    $findHospitalMainService = HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)->first();
    if(!$findHospitalMainService){
        return 0;
    }elseif($findHospitalMainService->support_B2B == 0){
        return 0;

    }elseif($findHospitalMainService->support_B2B == 1){
        return 1;

    }


}
function getPaymentMainServiceForHospital($hospitalId, $mainServiceId)
{
   return \App\Models\PaymentHospitalMainService::query()->paymentMainServiceForHospital($hospitalId, $mainServiceId)->get();
}



