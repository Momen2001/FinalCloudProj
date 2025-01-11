<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//use Gate;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['countries'] = Country::query()->OrderById()->get();
        return view('admin.country.index', $data);
    }

    public function create()
    {

    }

    public function store(CountryRequest $request)
    {

    }

    public function edit($countryId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['country'] = Country::query()->find($countryId);
        return view('admin.country.edit', $data);
    }

     public function show ($countryId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['country'] = Country::query()->find($countryId);
        return view('admin.country.show', $data);
    }

    public function update(CountryRequest $request, $medicalTypeId)
    {

        DB::beginTransaction();

        $Country = Country::query()->find($medicalTypeId);
        $data =[
            'ar' => [
                'title' => $request->title_ar,
            ],
            'en' => [
                'title' => $request->title_en,
            ],
            'status' => $request->status,
            'iso3' => $request->iso3,
            'iso2' => $request->iso2,
            'phone_code' => $request->phone_code,
            'timezone' => $request->timezone,
//            'lat' => $request->lat,
//            'lng' => $request->lng,

        ];

        if ($request->has('flag')) {
            $file = uniqid() . '.' . $request->flag->guessExtension();
            $request->file('flag')->storeAs('public/flags', $file);
            $data['flag'] = $file;
        }

        $Country->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }


}
