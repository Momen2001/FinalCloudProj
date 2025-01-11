<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePatientRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $data['patients'] = User::query()->wherePatient()->orderBy('id', 'DESC')->get();
        return view('admin.patients.index', $data);
    }


    public function store(Request $request)
    {

    }


    public function edit($patientId)
    {
        $data['patient'] = User::query()->wherePatient()->find($patientId);
        $data['countries'] = Country::query()->Active()->get();
        $data['cities'] = City::query()->where('country_id', $data['patient']['country_id'])->get();
        return view('admin.patients.edit', $data);
    }

    public function update(UpdatePatientRequest $request, $patientId)
    {
        $patient = User::query()->wherePatient()->find($patientId);

        DB::beginTransaction();

        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $patient->photo = $file;
        }

        $country = Country::query()->find($request->country_id);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'intro' => $country->phone_code,
            'country_id' => $country->id,
            'city_id' => $request->city_id,
            'passport_id' => $request->passport_id,
            'insurance_comp_id' => $request->insurance_comp_id,
            'gender' => $request->gender,
          ];

        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $data['photo'] = $file;
        }

        if (isset($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        $patient->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($patientId)
    {
        $data['patient'] = User::query()->wherePatient()->find($patientId);
        return view('admin.patients.show', $data);
    }

    public function destroy($patientId)
    {
        $patient = User::find($patientId);
        if (!$patient) {
            return response()->json(['status' => true, 'msg' => trans('cruds.hospital_not_found')]);
        } else {
            $patient->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_hospital_successfully')]);
    }


}
