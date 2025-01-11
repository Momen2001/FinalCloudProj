<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//use Gate;
use App\Http\Requests\Admin\MedicalTypesRequest;
use App\Http\Requests\Admin\MedicalTypeRequest;
use App\Models\MedicalType;
use Illuminate\Support\Facades\DB;

class MedicalTypeController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['medicalType'] = MedicalType::query()->OrderById()->get();
        return view('admin.medicalType.index', $data);
    }

    public function create()
    {

    }

    public function store(MedicalTypesRequest $request)
    {
//        dd($request->all());
         DB::beginTransaction();
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/medicalType', $file);
            $request->photo = $file;
        }

        MedicalType::query()->create([
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
            ],
            'photo' => $file,
            'status' => $request->status,
            'parent' => $request->parent,

        ]);


        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($medicalTypeId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['medicalType'] = MedicalType::query()->find($medicalTypeId);
        $data['allMedicalType'] = MedicalType::query()->Active()->get();
        return view('admin.medicalType.edit', $data);
    }

     public function show ($medicalTypeId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['medicalType'] = MedicalType::query()->find($medicalTypeId);
        return view('admin.medicalType.show', $data);
    }

    public function update(MedicalTypesRequest $request, $medicalTypeId)
    {

        DB::beginTransaction();

        $MedicalType = MedicalType::query()->find($medicalTypeId);
        $data =[
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
            ],
            'status' => $request->status,
            'parent' => $request->parent,

        ];

        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/medicalType', $file);
            $data['photo'] = $file;
        }

        $MedicalType->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
