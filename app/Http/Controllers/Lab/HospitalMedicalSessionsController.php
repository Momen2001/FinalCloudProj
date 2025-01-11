<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hospital\HospitalMedicalSessionsRequest;
use App\Models\DoctorService;
use App\Models\HospitalMainService;
use App\Models\HospitalServices;
use App\Models\MedicalSession;
use App\Models\MedicalSessionHospital;
use App\Models\Service;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;

class HospitalMedicalSessionsController extends Controller
{
    public function index()
    {
        $hospital_id = auth()->user()->id;
        
        $hospital = User::query()->WhereHospital()->find($hospital_id);
        //check hospital work in supportive service
        $checkHospitalWorkInSupportiveService = HospitalMainService::query()->where('hospital_id', $hospital_id)->where('main_service_id', mainServiceById()['SupportiveService'])->first();
        if ($checkHospitalWorkInSupportiveService) {
            $data['hospitalMedicalSessions'] = $hospital->HospitalMedicalSessions;
            $data['hospitalServices'] = HospitalServices::query()->GetServicesBelongsToMainService($hospital_id, mainServiceById()['SupportiveService'])->with('service')->get();

            $medicalSessionUses = MedicalSessionHospital::query()->WhereHospital($hospital_id)->pluck('medical_session_id')->toArray();
            $data['medicalSessions'] = MedicalSession::query()->whereNotIn('id', $medicalSessionUses)->get();
            if ($data['medicalSessions']->count() == 0) {
                $data['msg'] = trans('global.not_available_other_medical_sessions');
            } else {
                $data['msg'] = trans('global.select_medical_sessions');
            }
            return view('hospital.medicalSessions.index', $data);
        }
    }

    public function store(HospitalMedicalSessionsRequest $request)
    {
        /***** update and create hospital specializations ***/
        $hospital_id = auth()->user()->id;
        $checkHospitalWorkInSupportiveService = HospitalMainService::query()->where('hospital_id', $hospital_id)->where('main_service_id', mainServiceById()['SupportiveService'])->first();
        if ($checkHospitalWorkInSupportiveService) {
            MedicalSessionHospital::query()->create([
                'hospital_id' => $hospital_id,
                'medical_session_id' => $request->medical_session_id,
                'price' => $request->price,
            ]);
            return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_some_error')]);
        }
    }


    public function edit($hospitalMedicalSessionsId)
    {
        $hospital_id = auth()->user()->id;
        $data['medicalSessionHospital'] = MedicalSessionHospital::query()->where('hospital_id', $hospital_id)->find($hospitalMedicalSessionsId);
        if ($data['medicalSessionHospital']) {
            return view('hospital.medicalSessions.edit', $data);
        } else {
            return redirect()->back();
        }
    }

    public function update(HospitalMedicalSessionsRequest $request, $hospitalMedicalSessionsId)
    {
        $hospital_id = auth()->user()->id;
        $medicalSessionHospital = MedicalSessionHospital::query()->where('hospital_id', $hospital_id)->find($hospitalMedicalSessionsId);
        if ($medicalSessionHospital) {
            $medicalSessionHospital->update(['price' => $request->price]);
            toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
            return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
        } else {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_some_error')]);
        }
    }

    public function show(User $user)
    {

    }

    public function destroy($hospitalMedicalSessionsId)
    {
        $hospital_id = auth()->user()->id;
        $medicalSessionHospital = MedicalSessionHospital::query()->where('hospital_id', $hospital_id)->find($hospitalMedicalSessionsId);

        if ($medicalSessionHospital) {
            $medicalSessionHospital->delete();
            return response()->json(['status' => true, 'msg' => trans('global.delete_successfully')]);
        } else {
            return redirect()->back();
        }
    }


    public function filterSessions(Request $request)
    {
        $hospital_id = auth()->user()->id;

        $medicalSessionUses = MedicalSessionHospital::query()->WhereHospital($hospital_id)->pluck('medical_session_id')->toArray();
        $medicalSession = MedicalSession::query()->where('service_id', $request->service_id)->whereNotIn('id', $medicalSessionUses)->get();

        return response()->json([
            'status' => true,
            'medical_sessions' => $medicalSession,
        ]);
    }

    public function filterSessionsDetails(Request $request)
    {
        $medicalSession = MedicalSession::query()->find($request->session_id);
        return response()->json([
            'status' => true,
            'medical_sessions' => $medicalSession,
        ]);
    }


    public function filterServiceByMainService(Request $request)
    {

        $hospitalId = auth()->user()->id;
        $mainServiceId = $request->main_service_id;
        $doctorId = $request->doctor_id;
        $checkHospitalHasMainService = HospitalMainService::query()->HospitalHasMainService($hospitalId, $mainServiceId)->first();
        if ($checkHospitalHasMainService) {

            $data['hospitalServices'] = HospitalServices::query()->GetServicesBelongsToMainService($hospitalId, $mainServiceId)->with('service')->get();
            $hospitalServicesId = $data['hospitalServices']->pluck('service_id')->toArray();
            $doctorServices = DoctorService::query()->where('doctor_id', $doctorId)->pluck('service_id')->toArray();
            $data['services'] = Service::query()->whereIn('id', $hospitalServicesId)->whereNotIn('id',$doctorServices)->get();

            $data['main_service_id'] = $mainServiceId;

            if ($data['services']->count() == 0) {
                $data['msg'] = trans('global.not_available_other_services');
            } else {
                $data['msg'] = trans('global.select_services');
            }
            return response()->json([
                'status' => true,
                'msg' => $data['msg'],
                'services' => $data['services'],
            ]);
        } else {
            toastr()->error(trans('global.sorry_cant_open_this_main_service'), ['timeOut' => 20000, 'closeButton' => true]);
            return redirect()->back();
        }


    }

}
