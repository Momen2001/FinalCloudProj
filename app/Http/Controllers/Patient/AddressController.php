<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddressRequest;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $data['addresses'] = Address::query()->where('user_id',auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('patient.address.index', $data);
    }

    public function store(AddressRequest $request)
    {

        DB::beginTransaction();

         Address::query()->create([
            'ar'=>[
                'title'=>$request->title_ar,
                'description'=>$request->description_ar,
            ],
            'en'=>[
                'title'=>$request->title_en,
                'description'=>$request->description_en,

            ],
            'user_id'=>auth()->user()->id,
             'status'=>$request->status,
             'latitude'=>$request->latitude,
             'longitude'=>$request->longitude,
        ]);
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);

        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($addressId)
    {
    }

    public function update(CouponRequest $request, $addressId)
    {
    }
    public function destroy( $addressId)
    {
        Address::query()->where( 'user_id',auth()->user()->id)->find($addressId)->delete();
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        DB::commit();
        return response()->json(['status' => true, 'msg' => trans('global.delete_success')]);
    }


}
