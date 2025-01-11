<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Models\HospitalMainService;
use App\Models\User;
use Illuminate\Http\Request;

class MainServiceController extends Controller
{
    public function index()
    {
        $hospital_id = auth()->user()->id;
        $hospital = User::query()->WhereLab()->find($hospital_id);
        $data['hospital_main_services'] = $hospital->hospitalMainServices;
        return view('lab.mainService.index', $data);
    }

    public function store(Request $request)
    {


    }

    public function edit($mainServiceId)
    {
        $hospital_id = auth()->user()->id;
        $data['hospitalMainService'] = HospitalMainService::query()->HospitalHasMainService($hospital_id, $mainServiceId)->with('mainService')->first();

        if ($data['hospitalMainService']) {
            //hospital has this $mainServiceId
            return view('lab.mainService.edit', $data);
        } else {
            //hospital not have this main service
            return redirect()->back();
        }

    }

    public function update(Request $request, $mainServiceId)
    {
        $hospital_id = auth()->user()->id;
        $hospitalMainService = HospitalMainService::query()->HospitalHasMainService($hospital_id, $mainServiceId)->with('mainService')->first();
        $can_work_out_side = $request->can_work_out_side;
        if ($hospitalMainService) {
            //hospital has this $mainServiceId
            $hospitalMainService->update([
                'can_work_out_side' => $can_work_out_side,
                'time_before_receiving' => $request->time_before_receiving,
            ]);

            return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
        } else {
            //hospital has this $mainServiceId
            return redirect()->back();
        }
    }

    public function show($id)
    {
    }

    public function destroy($id)
    {
    }



}
