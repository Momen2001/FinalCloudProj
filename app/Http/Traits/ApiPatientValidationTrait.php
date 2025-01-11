<?php

namespace App\Http\Traits;


trait ApiPatientValidationTrait
{

    public function requiredHospitalMainService($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'mainServicesId' => 'required|numeric|exists:main_services,id',
            'hospitalId' => 'required|numeric|exists:users,id',
            'search' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function availableDoctorValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'specializationId' => 'required|numeric|exists:specializations,id',
            'can_work_outside' => 'required|numeric|in:0,1',
            'main_service_id' => 'required|numeric|exists:main_services,id|in:1,2,3,4,13',
            'search' => 'nullable|string',
            'search_doctor_city' => 'nullable|numeric|exists:cities,id',
            'search_insurance_company' => 'nullable|numeric|exists:insurance_comps,id',
            'search_hospital_id' => 'nullable|numeric|exists:users,id',
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }
    public function doctorSpecializationsValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'doctor_id' => 'nullable|numeric|exists:users,id',
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function requiredSpecialization($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'specializationId' => 'required|numeric|exists:specializations,id',
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function contactUsValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required|string',
            'email' => 'required|email',
            'details' => 'required|string',
            'by_user' => 'required|string',
            'attachment_file' => 'nullable|mimes:jpeg,png,jpg,pdf',
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function updateNotificationStatusValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'status_notification' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function requiredUser($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'userId' => 'required|numeric|exists:users,id',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function storeTeleMedicValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'main_service_id' => 'required|numeric|exists:main_services,id|in:1,3',
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'doctor_id' => 'required|numeric|exists:users,id',
            'booking_date' => 'required',
            'booking_hour' => 'required',
            'sub_patient_id' => 'required',
            'use_insurance' => 'required|in:1,0',
            'comment' => 'nullable|string',
            'voice' => 'nullable|max:5000|mimes:mp3',
            'attachment_file' => 'nullable|max:150|mimes:jpeg,png,jpg,pdf',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function storeUrgentHomeVisitValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'main_service_id' => 'required|numeric|exists:main_services,id|in:2',
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'doctor_id' => 'required|numeric|exists:users,id',
            'address_id' => 'required|numeric|exists:addresses,id',
            'booking_date' => 'required',
            'booking_hour' => 'required',
            'sub_patient_id' => 'required',
            'use_insurance' => 'required|in:1,0',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'comment' => 'nullable|string',
            'voice' => 'nullable|max:5000|mimes:mp3',
            'attachment_file' => 'nullable|max:150|mimes:jpeg,png,jpg,pdf',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function storePublicServicesValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'specialization_id' => 'required|numeric|exists:specializations,id',
            'doctor_id' => 'required|numeric|exists:users,id',
            'booking_date' => 'required',
            'booking_hour' => 'required',
//            'latitude' => 'required',
//            'longitude' => 'required',
            'sub_patient_id' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function checkSubPatient($sub_patient_id): array
    {
        $subPatientIds = auth()->user()->subPatient->pluck('id')->toArray();
        $subPatientIds[] = auth()->user()->id;
        if (in_array($sub_patient_id, $subPatientIds)) {
            return ['status' => true, 'message' => []];
        } else {
            return ['status' => false, 'message' => trans('global.sorry_check_sup_patient')];
        }
    }

    public function checkPatientInsuranceCompany($sub_patient_id, $use_insurance): array
    {
        if ($use_insurance == 1) {
            $auth = auth()->user();
            if ($sub_patient_id == $auth->id) {
                $currentInsuranceCompany = auth()->user()->insuranceComp;
                $currentInsuranceCompanyId = $currentInsuranceCompany ? $currentInsuranceCompany->id : null;
            } else {
                $currentInsuranceCompanyId = SubPatient::query()->find($sub_patient_id)->insurance_comp_id;
            }

            if ($currentInsuranceCompanyId == null) {
                // If he activates the insurance activation option and he did not specify the insurance company from profile
                return ['status' => false, 'insuranceCompanyId' => null, 'message' => trans('global.cant_use_insurance_must_select_from_profile')];
            } else {
                return ['status' => true, 'insuranceCompanyId' => $currentInsuranceCompanyId, 'message' => ''];
            }

        } else {
            // The user does not want to use  insurance
            return ['status' => true, 'insuranceCompanyId' => null, 'message' => ''];
        }
    }

    public function checkCouponValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'coupon_code' => 'required',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }


    public function addRateValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'experience_rate' => 'required|numeric|max:5|min:0',
            'politeness_rate' => 'required|numeric|max:5|min:0',
            'respond_rate' => 'required|numeric|max:5|min:0',
            'comment' => 'required|string|max:150',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }
    public function offerPaymentMethodsValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'offer_id' => 'required|numeric|exists:offers,id',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function cancelOrderValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'order_id' => 'required|numeric|exists:orders,id',
            'cancel_reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }
    public function hospitalProfileValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'hospital_id' => 'required|numeric|exists:users,id',
         ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }
    public function doctorsHospitalValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'hospital_id' => 'required|numeric|exists:users,id',
            'main_service_id' => 'required|numeric|exists:main_services,id|in:1,2,3,4,13',
         ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function offersHospitalValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'hospital_id' => 'required|numeric|exists:users,id',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function checkInsuranceCompanyForHospitalMainServiceValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'place_service_provided' => 'required|numeric',
            'main_service_id' => 'required|numeric|exists:main_services,id',
            'insurance_id_selected_from_profile' => 'required|numeric|exists:insurance_comps,id',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

    public function doctorScheduleValidation($request): array
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'doctor_id' => 'required|numeric|exists:users,id',
            'main_service_id' => 'required|numeric|exists:main_services,id|in:1,2,3,4,13',
        ]);

        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->first()];
        } else {
            return ['status' => true, 'message' => []];
        }
    }

}















