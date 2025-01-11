<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\Education;
use App\Models\HospitalMainService;
use App\Models\HospitalServices;
use App\Models\Service;
use App\Models\User;

trait AdjustServiceTrait
{


    public function storeTrait($request)
    {
        $hospital_id = auth()->user()->id;
        $mainServiceId = Service::query()->findOrFail($request->service_id)->main_service_id;
        $checkHospitalHasService = HospitalMainService::query()->HospitalHasMainService($hospital_id, $mainServiceId)->with('mainService')->first();
        if ($checkHospitalHasService) {
            //assign Insurance company for this  mainService
            HospitalServices::query()->create([
                'hospital_id' => $hospital_id,
                'service_id' => $request->service_id,
                'price' => $request->price,
            ]);

            return response()->json(['status' => true, 'msg' => trans('cruds.create_successfully')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('cruds.sorry_hospital_not_have_this_main_service')]);
        }

    }

     public function updateTrait($request, $labServicesId)
    {
        $hospital_id = auth()->user()->id;
        $hospitalServices = HospitalServices::query()->where('hospital_id', $hospital_id)->find($labServicesId);

        if ($hospitalServices) {
            $hospitalServices->update(['price' => $request->price]);
            return response()->json(['status' => true, 'msg' => trans('cruds.update_successfully')]);
        } else {
            return redirect()->back();
        }
    }


    public function destroyTrait($labServicesId)
    {
        $hospital_id = auth()->user()->id;
        $hospitalServices = HospitalServices::query()->where('hospital_id', $hospital_id)->find($labServicesId);
        if ($hospitalServices) {
            $hospitalServices->delete();
            return response()->json(['status' => true, 'msg' => trans('global.delete_successfully')]);
        } else {
            return redirect()->back();
        }
    }


}
