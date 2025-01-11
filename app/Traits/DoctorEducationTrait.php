<?php

namespace App\Traits;

use App\Models\Country;
use App\Models\Education;
use App\Models\User;

trait DoctorEducationTrait
{
    public function indexTrait($doctorId = null): array
    {
        $authHospitalId = auth()->user()->id;
        $data['doctors'] = User::query()->whereDoctorInHospital($authHospitalId)->OrderById()->get();
        $data['countries'] = Country::query()->Active()->get();
        if ($doctorId) {
            $data['educations'] = Education::query()->whereDoctorId($doctorId)->whereDoctorFollowHospital($authHospitalId)->get();
        } else {
            $data['educations'] = Education::query()->whereDoctorFollowHospital($authHospitalId)->get();
        }
        return $data;
    }

    public function storeTrait($request, $doctor_id)
    {
        return Education::query()->create([
            'ar' => [
                'details' => $request->details_ar,
                'degree' => $request->degree_ar,
                'specialization' => $request->specialization_ar,
                'department' => $request->department_ar,
                'university' => $request->university_ar,
            ],
            'en' => [
                'details' => $request->details_en,
                'degree' => $request->degree_en,
                'specialization' => $request->specialization_en,
                'department' => $request->department_en,
                'university' => $request->university_en,
            ],
            'doctor_id' => $doctor_id,
            'completion_date' => $request->completion_date,
            'country_id' => $request->country_id,
        ]);
    }

    public function editTrait($educationId)
    {
        $authHospitalId = auth()->user()->id;
        $data['doctors'] = User::query()->WhereDoctorInHospital(auth()->user()->id)->OrderById()->get();
        $data['countries'] = Country::query()->Active()->get();
        $data['education'] = Education::query()->whereDoctorFollowHospital($authHospitalId)->find($educationId);
        return $data;
    }

    public function updateTrait($request, $educationId, $doctor_id)
    {
        $education = Education::query()->find($educationId);
        $education->update([
                'ar' => [
                    'details' => $request->details_ar,
                    'degree' => $request->degree_ar,
                    'specialization' => $request->specialization_ar,
                    'department' => $request->department_ar,
                    'university' => $request->university_ar,
                ],
                'en' => [
                    'details' => $request->details_en,
                    'degree' => $request->degree_en,
                    'specialization' => $request->specialization_en,
                    'department' => $request->department_en,
                    'university' => $request->university_en,
                ],
            'doctor_id' => $doctor_id,
                'completion_date' => $request->completion_date,
                'country_id' => $request->country_id,
            ]);

     }



}
