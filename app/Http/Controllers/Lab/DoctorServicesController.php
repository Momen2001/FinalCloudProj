<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\DoctorServicesRequest;
use App\Models\Country;
use App\Models\DoctorService;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class DoctorServicesController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hospital_id = auth()->user()->id;
        $hospital = User::query()->WhereHospital()->find($hospital_id);
        $data['countries'] = Country::query()->Active()->get();
        return view('hospital.doctor.create', $data);
    }

    public function store(DoctorServicesRequest $request)
    {
        $labId = auth()->user()->id;
        $doctorId = $request->doctor_id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($labId)->with('doctorService')->find($doctorId);
        if ($data['doctor']) {
            DoctorService::query()->create([
                'doctor_id' => $doctorId,
                'service_id' => $request->service_id,
            ]);
        }
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }


    public function edit($doctorId)
    {

    }

    public function update(Request $request, $Id)
    {

    }

    public function show($doctorId)
    {
        $hospitalId = auth()->user()->id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($hospitalId)->with('doctorService')->find($doctorId);
        $hospital = User::query()->WhereLab()->find($hospitalId);
        $data['hospital_main_services'] = $hospital->hospitalMainServices;
        return view('lab.doctorServices.show', $data);
    }

    public function destroy($doctorServiceId)
    {
        $hospitalId = auth()->user()->id;
        $doctor = DoctorService::query()->whereHas('doctor', function ($doctor) use ($hospitalId) {
            $doctor->whereHas('doctorSetting', function ($qq) use ($hospitalId) {
                $qq->where('hospital_id', $hospitalId);
            });
        })->find($doctorServiceId);

        if (!$doctor) {
            return response()->json(['status' => true, 'msg' => trans('cruds.doctor_not_found')]);
        } else {
            $doctor->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_doctor_successfully')]);
    }


}
