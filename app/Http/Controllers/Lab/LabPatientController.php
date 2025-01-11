<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Traits\HospitalPatientTrait;

class LabPatientController extends Controller
{
    use HospitalPatientTrait;

    public function index()
    {
        $data = $this->indexTrait();
        return view('lab.patients.index', $data);
    }

    public function show($patientId)
    {
        $data = $this->showTrait($patientId);
        if ($data['patientOrderChecking'] && $data['patient']) {
            return view('lab.patients.show', $data);
        }
        return redirect()->back();
    }


}
