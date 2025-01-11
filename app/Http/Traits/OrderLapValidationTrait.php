<?php

namespace App\Http\Traits;


 use App\Models\HospitalServices;
 use App\Models\OrderServices;
use App\Models\Service;


trait OrderLapValidationTrait
{




    public function hospitalWorkInServicesValidation($request): array
    {
        $data = [
            'services_id' => 'required|array|exists:services,id',
            'main_service_id' => 'required|exists:main_services,id',
            'can_work_outside' => 'required|numeric|in:0,1',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $data);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function storeSingleOrderValidation($request): array
    {
        $data = [
            'services.*' => 'required|exists:services,id',
            'main_service_id' => 'required|numeric|exists:main_services,id|in:7',
            'lab_id' => 'required|numeric|exists:users,id',
            'address_id' => 'nullable|numeric|exists:addresses,id',
            'booking_date' => 'required',
            'booking_hour' => 'required',
            'use_insurance' => 'required|in:1,0',
            'check_inside_hospital' => 'required|in:1,0',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'comment' => 'nullable|string',
            'voice' => 'nullable|max:5000|mimes:mp3',
            'attachment_file' => 'nullable|max:150|mimes:jpeg,png,jpg,pdf',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $data);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function checkServicesBelongsToMainService($mainServiceId, $services): array
    {
        foreach ($services as $service) {
            $findMainService = Service::query()->find($service)->main_service_id;
            if ($findMainService != $mainServiceId) {
                return ['status' => false, 'message' => trans('global.sorry_some_services_selected_not_belong_to_main_service')];
            }
        }
        return ['status' => true, 'message' => ""];
    }

    public function orderServices($order, $services)
    {
        foreach ($services as $service) {
            OrderServices::query()->updateOrCreate(
                [
                    'order_id' => $order->id,
                    'service_id' => $service,
                    'price' => HospitalServices::query()->servicesPriceHospital($order->hospital_id, $service),
                ]
            );
        }
    }

    public function orderPackage($order, $packageLabId)
    {



    }

    public function serviceIdValidation($request): array
    {
        $data = [
            'service_id' => 'required|exists:services,id',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $data);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function storePackageOrderValidation($request): array
    {
        $data = [
            'main_service_id' => 'required|numeric|exists:main_services,id|in:7',
            'package_lap_id' => 'required|exists:package_laps,id',
            'address_id' => 'nullable|numeric|exists:addresses,id',
            'lab_id' => 'required|numeric|exists:users,id',
            'booking_date' => 'required',
            'booking_hour' => 'required',
            'sub_patient_id' => 'required',
            'use_insurance' => 'required|in:1,0',
            'check_inside_hospital' => 'required|in:1,0',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'comment' => 'nullable|string',
            'voice' => 'nullable|max:5000|mimes:mp3',
            'attachment_file' => 'nullable|max:150|mimes:jpeg,png,jpg,pdf',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $data);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }




}

















