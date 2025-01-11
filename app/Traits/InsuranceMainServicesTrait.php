<?php

namespace App\Traits;


use App\Models\HospitalMainService;
use App\Models\InsuranceHospitalMainService;

trait InsuranceMainServicesTrait
{


    public function storeTrait($request)
    {
        $hospital_id = auth()->user()->id;
        $mainServiceId = $request->main_service_id;
        $checkHospitalHaveInsuranceMainService = InsuranceHospitalMainService::query()->CheckInsuranceMainServiceForHospital($hospital_id, $request->main_service_id, $request->insurance_comp_id)->first();

        if ($checkHospitalHaveInsuranceMainService) {
            return response()->json(['status' => true, 'msg' => trans('cruds.sorry_this_service_already_includes_this_insurance')]);
        }

        $checkHospitalHasMainService = HospitalMainService::query()->HospitalHasMainService($hospital_id, $mainServiceId)->with('mainService')->first();
        if ($checkHospitalHasMainService) {
            //assign Insurance company for this  mainService

            if (in_array($mainServiceId, [mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare'], mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic']])) {
                //just supported the insurance (outside) hospital
                $place_service_provided = placeServiceProvided()['out_side_hospital'];
            } elseif ($mainServiceId == mainServiceById()['Appointment']) {
                $place_service_provided = placeServiceProvided()['inside_hospital'];   //just supported the insurance (inside) hospital
            } else {
                //optional supported the insurance (outside) or (inside) hospital
                $place_service_provided = $request->place_service_provided;
            }
            InsuranceHospitalMainService::query()->create([
                'hospital_id' => $hospital_id,
                'main_service_id' => $mainServiceId,
                'insurance_comp_id' => $request->insurance_comp_id,
                'place_service_provided' => $place_service_provided,
//                'discount_percentage' => $request->discount_percentage,
            ]);
            return response()->json(['status' => true, 'msg' => trans('cruds.create_successfully')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('cruds.sorry_hospital_not_have_this_main_service')]);

        }

    }

     public function updateTrait($request, $insuranceHospitalMainServiceId)
    {
        // not used this function now
        $hospital_id = auth()->user()->id;
        $insuranceHospitalMainService = InsuranceHospitalMainService::query()
            ->whereHospital($hospital_id)->find($insuranceHospitalMainServiceId);
        if ($insuranceHospitalMainService) {
            $insuranceHospitalMainService->update(['place_service_provided' => $request->place_service_provided]);
            return response()->json(['status' => true, 'msg' => trans('cruds.update_successfully')]);
        } else {
            return redirect()->back();
        }
    }


    public function destroyTrait($insuranceHospitalMainServiceId)
    {
        $hospital_id = auth()->user()->id;
        $insuranceHospitalMainService = InsuranceHospitalMainService::query()
            ->whereHospital($hospital_id)->find($insuranceHospitalMainServiceId);
        if ($insuranceHospitalMainService) {
            $insuranceHospitalMainService->delete();
            return response()->json(['status' => true, 'msg' => trans('global.delete_successfully')]);
        } else {
            return redirect()->back();
        }
    }


}
