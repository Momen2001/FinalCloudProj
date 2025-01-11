<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\DoctorExperienceRequest;
use App\Models\Experience;
use App\Models\User;
use App\Traits\DoctorExperiencesTrait;
use Illuminate\Http\Request;

class DoctorExperiencesController extends Controller
{
    use DoctorExperiencesTrait;
    public function index(Request $request)
    {
        $data = $this->indexTrait($request->doctorId);
        return view('lab.experience.index', $data);
    }

    public function create()
    {

    }

    public function store(DoctorExperienceRequest $request)
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

    public function edit($experienceId)
    {
        $data = $this->editTrait($experienceId);
        return view('lab.experience.edit', $data);
    }

    public function update(DoctorExperienceRequest $request, $experienceId)
    {
        $authHospitalId = auth()->user()->id;
        $experience = Experience::query()->whereDoctorFollowHospital($authHospitalId)->find($experienceId);
        if ($experience) {
            $this->updateTrait($request, $experienceId, $request->doctor_id);
        } else {
            return response()->json(['status' => false, 'msg' => 'cant update.']);
        }
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($experienceId)
    {

    }

    public function destroy($experienceId)
    {
        $authHospitalId = auth()->user()->id;
        $experience = Experience::query()->whereDoctorFollowHospital($authHospitalId)->find($experienceId);
        if (!$experience) {
            return response()->json(['status' => true, 'msg' => trans('cruds.sorry_this_doctor_not_follow_to_hospital')]);
        } else {
            $experience->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('global.delete_successfully')]);
    }

}
