<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CitiesRequest;
use App\Models\City;

class CitiesController extends Controller
{
    public function index($countryId)
    {
        $data['cities'] = City::query()->where('country_id', $countryId)->get();
        $data['countryId'] = $countryId;
        return view('admin.cities.index', $data);
    }

    public function store(CitiesRequest $request, $countryId)
    {
        City::create([
            'ar' => [
                'title' => $request->title_ar
            ],
            'en' => [
                'title' => $request->title_en
            ],
            'status' => $request->status,
            'country_id' => $countryId,

        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($cityId)
    {
        $data['city'] = City::query()->find($cityId);
        return view('admin.cities.edit', $data);
    }

    public function update(CitiesRequest $request, $cityId)
    {
        City::query()->find($cityId)->update([
            'ar' => [
                'title' => $request->title_ar
            ],
            'en' => [
                'title' => $request->title_en
            ],
            'status' => $request->status,
        ]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


    public function destroy($cityId)
    {
        City::query()->find($cityId)->delete();
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
