<?php

namespace App\Traits;

use App\Models\Order;
use App\Models\User;

trait HospitalPatientTrait
{
    public function indexTrait(): array
    {
        $hospitalId = auth()->user()->id;
        $ownerPatientsId = Order::query()
            ->where('hospital_id', $hospitalId)->distinct()
            ->pluck('owner_patient_id');
        $data['patients'] = User::query()->whereIn('id', $ownerPatientsId)->get();
        return $data;
    }

    public function showTrait($patientId)
    {
        $hospitalId = auth()->user()->id;
        $data['patient'] = User::query()->wherePatient()->find($patientId);
        $hospitalDoctors = User::query()->WhereDoctorInHospital($hospitalId)->pluck('id')->toArray();
        // Note: The patient must have made at least one reservation from the hospital or from a doctor within the hospital
        $data['patientOrderChecking'] = Order::query()
            ->where('owner_patient_id', $patientId)
            ->whereIn('doctor_id', $hospitalDoctors)
            ->orWhere('hospital_id', $hospitalId)->exists();
        return $data;
    }


}
