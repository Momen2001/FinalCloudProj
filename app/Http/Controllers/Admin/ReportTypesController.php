<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReportTypesRequest;

//use Gate;
use App\Models\MainService;
use App\Models\ReportType;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ReportTypesController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['reportTypes'] = ReportType::query()->OrderById()->get();
        return view('admin.reportType.index', $data);
    }

    public function create()
    {

    }

    public function store(ReportTypesRequest $request)
    {
//        dd($request->all());
         DB::beginTransaction();
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/reportType', $file);
            $request->photo = $file;
        }
        ReportType::query()->create([
            'ar' => [
                'title' => $request->title_ar,
            ],
            'en' => [
                'title' => $request->title_en,
            ],
            'color' => $request->color,
            'photo' => $file,
        ]);
        DB::commit();
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($reportTypeId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['reportType'] = ReportType::query()->find($reportTypeId);
        return view('admin.reportType.edit', $data);
    }

     public function show ()
    {

    }

    public function update(ReportTypesRequest $request, $reportTypeId)
    {

        DB::beginTransaction();

        $service = ReportType::query()->find($reportTypeId);


        $data =[
            'ar' => [
                'title' => $request->title_ar,
            ],
            'en' => [
                'title' => $request->title_en,
            ],
            'color' => $request->color,
        ];


        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/reportType', $file);
            $data['photo'] = $file;
        }


        $service->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
