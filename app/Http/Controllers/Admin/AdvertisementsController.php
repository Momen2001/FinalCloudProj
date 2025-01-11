<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvertisementRequest;
use App\Models\Advertisement;
use App\Models\ContactUs;
use App\Models\Service;
use Gate;
use Illuminate\Support\Facades\DB;

class AdvertisementsController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['advertisements'] = Advertisement::query()->orderBy('id', 'DESC')->get();
        return view('admin.advertisements.index', $data);
    }

    public function edit($advertisementId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['advertisement'] = Advertisement::query()->find($advertisementId);
        return view('admin.advertisements.edit', $data);
    }

    public function update(AdvertisementRequest $request, $advertisement)
    {
        DB::beginTransaction();

        $advertisement = Advertisement::query()->find($advertisement);

        $data = [
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
                'btn_text' => $request->btn_text_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
                'btn_text' => $request->btn_text_en,
            ],
            'status' => $request->status,
            'link' => $request->link,
            'color_degree' => $request->color_degree,
            'btn_show' => $request->btn_show,
        ];


        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/advertisements', $file);
            $data['photo'] = $file;
        }


        $advertisement->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function store(AdvertisementRequest $request)
    {
        DB::beginTransaction();
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/advertisements', $file);
            $request->photo = $file;
        }
        Advertisement::query()->create([
            'ar' => [
                'title' => $request->title_ar,
                'description' => $request->description_ar,
                'btn_text' => $request->btn_text_ar,
            ],
            'en' => [
                'title' => $request->title_en,
                'description' => $request->description_en,
                'btn_text' => $request->btn_text_en,
            ],
            'status' => $request->status,
            'link' => $request->link,
            'color_degree' => $request->color_degree,
            'btn_show' => $request->btn_show,
            'photo' => $file,
        ]);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }


    public function show($advertisement)
    {
        // abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['advertisement'] = Advertisement::query()->find($advertisement);
        return view('admin.advertisements.show', $data);
    }

    public function destroy($advertisement)
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Advertisement::query()->find($advertisement)->delete();
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }

}
