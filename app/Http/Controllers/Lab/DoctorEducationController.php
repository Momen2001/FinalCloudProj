<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\DoctorEducationRequest;
use App\Models\Education;
use App\Models\User;
use App\Traits\DoctorEducationTrait;
use Illuminate\Http\Request;

class DoctorEducationController extends Controller
{
    use DoctorEducationTrait;
    public function index(Request $request)
    {
        $data = $this->indexTrait($request->doctorId);
        return view('lab.education.index', $data);
    }

    public function create()
    {

    }

    public function store(DoctorEducationRequest $request)
    {
        $authHospitalId = auth()->user()->id;
        $data['doctors'] = User::query()->WhereDoctorInHospital($authHospitalId)->find($request->doctor_id);
        if (!$data['doctors']) {
            toastr()->error(trans('global.sorry_this_doctor_not_follow_to_hospital'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        } else {
            $this->storeTrait($request, $request->doctor_id);
        }
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }


    public function edit($educationId)
    {
        $data=$this->editTrait($educationId);
        return view('lab.education.edit', $data);
    }


    public function update(DoctorEducationRequest $request, $educationId)
    {
        $authHospitalId = auth()->user()->id;
        $education = Education::query()->whereDoctorFollowHospital($authHospitalId)->find($educationId);
        if ($education) {
            $this->updateTrait($request, $educationId, $request->doctor_id);
        } else {
            return response()->json(['status' => false, 'msg' => 'cant update.']);
        }
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


    public function show($educationId)
    {

    }

    public function destroy($educationId)
    {
        $authHospitalId = auth()->user()->id;
        $education = Education::query()->whereDoctorFollowHospital($authHospitalId)->find($educationId);
        if (!$education) {
            return response()->json(['status' => true, 'msg' => trans('cruds.sorry_this_doctor_not_follow_to_hospital')]);
        } else {
            $education->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_education_successfully')]);
    }
}
