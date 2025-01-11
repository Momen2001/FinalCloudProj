<?php

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\RejectReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class HomeController
{
    public function filterCities(Request $request)
    {
        $areas = City::query()->where('country_id', $request->country_id)->get();

        return response()->json([
            'status' => true,
            'cities' => $areas,
        ]);
    }

    public function change_language($lang)
    {
        Session::put('locale', $lang);
        return redirect()->back()->with('success', trans('global.language_updated_successfully',[],$lang));
    }

    public function getRejectReasons()
    {
        $reasons = RejectReason::query()->get(); // Adjust the columns as per your database schema
        return response()->json(['status' => true, 'reasons' => $reasons]);
    }

}
