<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LabRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\HospitalLocation;
use App\Models\HospitalMainService;
use App\Models\MainService;
use App\Models\Offer;
use App\Models\OfferPaymentMethod;
use App\Models\PaymentHospitalMainService;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    public function index()
    {
        $data['labs'] = User::query()->WhereLab()->orderBy('id', 'DESC')->get();
        $data['countries'] = Country::query()->Active()->get();
        $data['main_service'] = MainService::query()->active()->find(mainServiceById()['Lab']);
        $data['payment_methods'] = PaymentMethod::query()->active()->get();

        return view('admin.labs.index', $data);
    }


    public function store(LabRequest $request)
    {

        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }
        DB::beginTransaction();
        $country = Country::query()->find($request->country_id);
        $lab_created = User::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'provider_name_ar' => $request->provider_name_ar,
            'provider_name_en' => $request->provider_name_en,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'photo' => $file,
            'intro' => $country->phone_code,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'role_id' => 2, //Lab
            'platform' => 'web', //hospital
            'verification_token' => null,
            'verified_at' => null,
            'verified' => 1,
            'email_verified_at' => Carbon::now(), //hospital
        ]);

        HospitalLocation::query()->create([
            'ar' => [
                'location' => $request->location_ar
            ],
            'en' => [
                'location' => $request->location_en
            ],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'hospital_id' => $lab_created->id,
        ]);

        $mainService = MainService::query()->find($request->main_service_id); //lab main service
        $checkSupportB2B = isset($request->support_B2B);
        $checkMainServicePaymentMethods = isset($request->payment_methods);
        $checkCommission = isset($request->commission);

        if (!$checkMainServicePaymentMethods) {
            return response()->json(['status' => false, 'msg' => trans('global.sorry_must_select_payment_method', ['mainService' => $mainService->title])]);
        }

        HospitalMainService::query()->create([
            'main_service_id' => $mainService->id,
            'commission' => $checkCommission ? $request->commission : 0,
            'support_B2B' => $checkSupportB2B ? $request->support_B2B : 0,
            'hospital_id' => $lab_created->id,
        ]);

        foreach ($request->payment_methods as $mainServicePaymentMethod) {
            \App\Models\PaymentHospitalMainService::query()->updateOrCreate([
                'hospital_id' => $lab_created->id,
                'main_service_id' => $mainService->id,
                'payment_method_id' => $mainServicePaymentMethod,
            ]);
        }

        DB::commit();
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }


    public function edit($lablId)
    {
        $data['lab'] = User::query()->WhereLab()->find($lablId);
        $data['countries'] = Country::query()->Active()->get();
        $data['cities'] = City::query()->where('country_id', $data['lab']['country_id'])->get();
        $data['main_service'] = MainService::query()->active()->find(mainServiceById()['Lab']);
        $data['payment_methods'] = PaymentMethod::query()->active()->get();
        return view('admin.labs.edit', $data);
    }

    public function update(LabRequest $request, $lablId)
    {
        $hospital = User::query()->WhereLab()->find($lablId);
        $mainServiceId = mainServiceById()['Lab'];
        DB::beginTransaction();

        $country = Country::query()->find($request->country_id);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'provider_name_ar' => $request->provider_name_ar,
            'provider_name_en' => $request->provider_name_en,
            'email' => $request->email,
            'phone' => $request->phone,
            'intro' => $country->phone_code,
            'country_id' => $country->id,
            'city_id' => $request->city_id,
            'role_id' => 2, //Lab
            'platform' => 'web', //hospital
        ];
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $data['photo'] = $file;
        }

        if (isset($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $hospital->update($data);
        $hospitalLocation = HospitalLocation::query()->whereHospitalId($lablId)->first();
        $data = [
            'ar' => [
                'location' => $request->location_ar
            ],
            'en' => [
                'location' => $request->location_en
            ],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'hospital_id' => $lablId,
        ];
        if ($hospitalLocation) {
            $hospitalLocation->update($data);
        }else{
            HospitalLocation::query()->create($data);
        }


        HospitalMainService::query()->updateOrCreate([
            'main_service_id' => $mainServiceId,
            'hospital_id' => $lablId,
        ], [
            'commission' => $request->commission,
            'support_B2B' => $request->support_B2B,
        ]);

        PaymentHospitalMainService::query()->whereHospital($lablId)->forcedelete();

        foreach ($request->payment_methods as $mainServicePaymentMethod) {
            \App\Models\PaymentHospitalMainService::query()->updateOrCreate([
                'hospital_id' => $lablId,
                'main_service_id' => $mainServiceId,
                'payment_method_id' => $mainServicePaymentMethod,
            ]);
        }

        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($lablId)
    {
        $data['lab'] = User::query()->WhereLab()->find($lablId);
        return view('admin.labs.show',$data);
    }

    public function destroy($hospitalId)
    {
        $hospitalId = User::find($hospitalId);

        if (!$hospitalId) {
            return response()->json(['status' => true, 'msg' => trans('cruds.hospital_not_found')]);
        } else {
            $hospitalId->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_hospital_successfully')]);
    }

    public function deleteUnselectedPaymentGateways($hospitalId, $paymentMethodsMainServiceId)
    {
        $hospitalOfferIds = Offer::query()->whereHospital($hospitalId)->pluck('id')->toArray();
        //Delete all payment gateways that are not assigned to offer service
        OfferPaymentMethod::query()->whereIn('offer_id', $hospitalOfferIds)
            ->whereNotIn('payment_method_id', $paymentMethodsMainServiceId)->forceDelete();
    }
}
