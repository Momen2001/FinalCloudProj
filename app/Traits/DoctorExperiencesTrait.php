<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\Experience;
use App\Models\User;

trait DoctorExperiencesTrait
{
    public function indexTrait($doctorId = null): array
    {
        $authHospitalId = auth()->user()->id;
        $data['doctors'] = User::query()->WhereDoctorInHospital($authHospitalId)->OrderById()->get();
        $data['countries'] = Country::query()->Active()->get();
        if ($doctorId) {
            $data['experiences'] = Experience::query()->whereDoctorId($doctorId)->whereDoctorFollowHospital($authHospitalId)->get();
        } else {
            $data['experiences'] = Experience::query()->whereDoctorFollowHospital($authHospitalId)->get();
        }
        return $data;
    }

    public function storeTrait($request, $doctor_id)
    {
        return  Experience::query()->create([
            'ar' => [
                'details' => $request->details_ar,
                'company' => $request->company_ar,
                'position' => $request->position_ar,
            ],
            'en' => [
                'details' => $request->details_en,
                'company' => $request->company_en,
                'position' => $request->position_en,
            ],
            'doctor_id' => $doctor_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'country_id' => $request->country_id,
        ]);
    }

    public function editTrait($experienceId)
    {
        $authHospitalId = auth()->user()->id;
        $data['doctors'] = User::query()->WhereDoctorInHospital(auth()->user()->id)->OrderById()->get();
        $data['countries'] = Country::query()->Active()->get();
        $data['experience'] = Experience::query()->whereDoctorFollowHospital($authHospitalId)->find($experienceId);
        return $data;
    }

    public function updateTrait($request, $experienceId, $doctor_id)
    {
        $education = Experience::query()->find($experienceId);
        $education->update([
                'ar' => [
                    'details' => $request->details_ar,
                    'company' => $request->company_ar,
                    'position' => $request->position_ar,
                ],
                'en' => [
                    'details' => $request->details_en,
                    'company' => $request->company_en,
                    'position' => $request->position_en,
                ],
            'doctor_id' => $doctor_id,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'country_id' => $request->country_id,
            ]);
    }


}
