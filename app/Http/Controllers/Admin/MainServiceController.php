<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MainServiceRequest;
use App\Models\MainService;
use Illuminate\Support\Facades\DB;

class MainServiceController extends Controller
{
    public function index()
    {
        $data['main_services'] = MainService::query()->get();
        return view('admin.mainService.index', $data);
    }


    public function edit($mainServiceId)
    {
        $data['main_service'] = MainService::query()->find($mainServiceId);

        return view('admin.mainService.edit', $data);
    }

    public function show($mainServiceId)
    {

    }

    public function update(MainServiceRequest $request, $MainServiceId)
    {
        $MainService = MainService::query()->find($MainServiceId);
        DB::beginTransaction();

        $data = [
            'ar' => [
                "title" => $request->title_ar
            ],
            'en' => [
                "title" => $request->title_en
            ],
            'status' => $request->status,
        ];

        if ($request->has('photo')) {
            $data['photo'] = uploadImage('main-service', $request->photo);
        }
        $MainService->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
