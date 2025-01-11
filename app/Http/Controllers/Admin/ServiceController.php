<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\MainService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use Gate;

class ServiceController extends Controller
{
    private function getMainServicesArray()
    {
        return [
            mainServiceById()['HomeCare'],
            mainServiceById()['Vitamin'],
            mainServiceById()['Nurse'],
            mainServiceById()['Radiology'],
            mainServiceById()['Caregiver'],
            mainServiceById()['Vaccine'],
            mainServiceById()['Lab']
        ];
    }

    public function index(Request $request)
    {
        $mainServiceId = $request->main_service_id;
        //      abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['services'] = Service::query()->when($mainServiceId, function ($query) use ($mainServiceId) {
            $query->where('main_service_id', $mainServiceId);
        })->OrderById()->get();
        return view('admin.services.index', $data);
    }

    public function create(Request $request)
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->customServiceId) {
            $data['customServiceId'] = $request->customServiceId;
        } else {

            $data['mainServices'] = MainService::query()
                ->whereIn('id', $this->getMainServicesArray())
                ->orderBy('id', 'DESC')
                ->get();
            $data['customServiceId'] = null;

        }
        return view('admin.services.create', $data);
    }

    public function store(ServiceRequest $request)
    {
//        dd($request->all());
        DB::beginTransaction();
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/services', $file);
            $request->photo = $file;
        }
        Service::query()->create([
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
                'instructions' => $request->instructions_ar,
                'include' => $request->include_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
                'instructions' => $request->instructions_en,
                'include' => $request->include_en,
            ],
            'photo' => $file,
            'main_service_id' => $request->main_service_id,
            'status' => $request->status,
        ]);
        DB::commit();
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($serviceId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['service'] = Service::query()->find($serviceId);

        $data['mainServices'] = MainService::query()
            ->whereIn('id', $this->getMainServicesArray())
            ->orderBy('id', 'DESC')->get();
        return view('admin.services.edit', $data);
    }

    public function show($serviceId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['service'] = Service::query()->find($serviceId);
        return view('admin.services.show', $data);
    }

    public function update(ServiceRequest $request, $serviceId)
    {

        DB::beginTransaction();

        $service = Service::query()->find($serviceId);


        $data = [
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
                'instructions' => $request->instructions_ar,
                'include' => $request->include_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
                'instructions' => $request->instructions_en,
                'include' => $request->include_en,
            ],
            'main_service_id' => $request->main_service_id,
            'status' => $request->status,
        ];


        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/services', $file);
            $data['photo'] = $file;
        }


        $service->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
