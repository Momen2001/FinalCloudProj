<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManagerRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Gate;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
//        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['admins'] = User::query()->WhereAdmin()->orderBy('id', 'DESC')->get();
        $data['countries'] = Country::query()->get();
        return view('admin.managers.index', $data);
    }

    public function store(ManagerRequest $request)
    {
//        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }
        DB::beginTransaction();
        User::query()->create([
            'role_id' => 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'intro' => $request->intro,
            'email' => $request->email,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'platform' => 'web',
            'password' => bcrypt($request->password),
            'remember_token' => null,
            'verified' => 1,
            'trust_phone' => 1,
            'verified_at' => '2022-06-15 13:47:44',
            'verification_token' => '',
            'two_factor_code' => '',
        ]);
        DB::commit();
        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }

    public function edit($adminId)
    {
//        abort_if(Gate::denies('hospital_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['admin'] = User::query()->WhereAdmin()->find($adminId);
        $data['countries'] = Country::query()->get();
        $data['cities'] = City::query()->where('country_id', $data['admin']['country_id'])->get();
        return view('admin.managers.edit', $data);
    }

    public function update(ManagerRequest $request, $adminId)
    {
        $admin = User::query()->WhereAdmin()->find($adminId);

        DB::beginTransaction();

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'intro' => $request->intro,
            'email' => $request->email,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
        ];
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
            $data ['photo'] = $file;
        }

        if (isset($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
        $admin->update($data);
        DB::commit();

        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show(User $user)
    {
//        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.managers.show', compact('user'));
    }

    public function destroy($adminId)
    {
//        abort_if(Gate::denies('hospital_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $adminId = User::find($adminId);
        if (!$adminId) {
            return response()->json(['status' => true, 'msg' => trans('cruds.hospital_not_found')]);
        } else {
            $adminId->delete();
        }
        return response()->json(['status' => true, 'msg' => trans('cruds.delete_hospital_successfully')]);
    }


}
