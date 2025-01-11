<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\MainService;
use App\Models\User;

trait DoctorTrait
{
    public function indexTrait(): array
    {
        $data['doctors'] = User::query()->WhereDoctorInHospital(auth()->user()->id)->OrderById()->get();
        $data['countries'] = Country::query()->Active()->get();
        $data['main_services'] = MainService::query()->active()->get();
        return $data;
    }

    public function showTrait($doctorId)
    {
        $hospitalId = auth()->user()->id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($hospitalId)->find($doctorId);
        return $data;
    }

    public function destroyTrait($doctorId): \Illuminate\Http\JsonResponse
    {
        $hospitalId = auth()->user()->id;
        $doctorId = User::query()->WhereDoctorInHospital($hospitalId)->find($doctorId);
        if (!$doctorId) {
            return response()->json(['status' => true, 'msg' => trans('cruds.doctor_not_found')]);
        } else {
            $doctorId->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_doctor_successfully')]);
    }


}
