<?php

namespace App\Http\Controllers\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lab\DoctorLabRequest;
use App\Http\Resources\WorkScheduleResource;
use App\Models\City;
use App\Models\Country;
use App\Models\DoctorSetting;
use App\Models\ScheduleHourInHospital;
use App\Models\ScheduleInHospital;
use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\WorkScheduleHours;
use App\Traits\DoctorTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorsController extends Controller
{
    use DoctorTrait;
    public function index()
    {
        $data = $this->indexTrait();
        return view('lab.doctor.index', $data);
    }

    public function create()
    {
        $data['countries'] = Country::query()->Active()->get();
        return view('lab.doctor.create', $data);
    }

    public function store(DoctorLabRequest $request)
    {
        $file = null;
        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }
        DB::beginTransaction();
        $country = Country::query()->findOrFail($request->country_id);
        $doctor_created = User::query()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_en' => $request->first_name_en,
            'last_name_en' => $request->last_name_en,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'passport_id' => $request->passport_id,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'intro' => $country->phone_code,
            'photo' => $file,
            'role_id' => 4, //doctor
            'platform' => 'ios',
            'gender' => $request->gender,

        ]);


        foreach (staticDays() as $day) {
            WorkSchedule::query()->create(
                [
                    'doctor_id' => $doctor_created->id,
                    'day_name' => $day,
                    'active' => true,
                ]);
            ScheduleInHospital::query()->create(
                [
                    'doctor_id' => $doctor_created->id,
                    'day_name' => $day,
                    'active' => true,
                ]);
        }

       DoctorSetting::query()->create([
           'doctor_id' => $doctor_created->id,
           'hospital_id' => auth()->user()->id,
           'experience_start_work' => $request->experience_start_work,
           'home_visit_price' => $request->home_visit_price,
           'in_hospital_price' => $request->in_hospital_price,
           'can_work_in_home_visit' => $request->can_work_in_home_visit,
           'can_work_in_hospital' => $request->can_work_in_hospital,
           'speciality' => $request->speciality,
           'speciality_en' => $request->speciality_en,
           'license' => $request->license,
           'bio' => $request->bio,
           'education' => "",
           'experience' => "",
           'can_work_emergency_online' => 0,
           'can_work_emergency_home_visit' => 0,
           'can_work_online' => 0,
           'emergency_online_price' => 0,
           'emergency_home_visit_price' => 0,
           'online_price' => 0,

       ]);
        DB::commit();
//        toastr()->success(trans('global.create_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
    }


    public function edit($doctorId)
    {
        $hospitalId = auth()->user()->id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($hospitalId)->find($doctorId);
        $data['cities'] = City::query()->WhereCountry($data['doctor']['country_id'])->get();
        $data['countries'] = Country::query()->Active()->get();
        return view('lab.doctor.edit', $data);
    }

    public function update(DoctorLabRequest $request, $doctorId)
    {
        $hospitalId = auth()->user()->id;
        $doctor = User::query()->WhereDoctorInHospital($hospitalId)->find($doctorId);

        DB::beginTransaction();

        if ($request->has('photo')) {
            $file = uniqid() . '.' . $request->photo->guessExtension();
            $request->file('photo')->storeAs('public/users', $file);
            $request->photo = $file;
        }
        $country = Country::query()->findOrFail($request->country_id);
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_name_en' => $request->first_name_en,
            'last_name_en' => $request->last_name_en,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'passport_id' => $request->passport_id,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'intro' => $country->phone_code,
            'role_id' => 4, //doctor
            'platform' => 'ios', //hospital
            'gender' => $request->gender, //hospital
            'verified_at' => Carbon::now(),
            'verified' => 1,
            'verification_token' => null,
            //hospital
        ];

        if (isset($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
        if (isset($request->photo)) {
            $data['photo'] = $file;
        }
        $doctor->update($data);

        $doctor->doctorSetting->update([
            'doctor_id' => $doctor->id,
            'hospital_id' => auth()->user()->id,
            'experience_start_work' => $request->experience_start_work,
            'home_visit_price' => $request->home_visit_price,
            'in_hospital_price' => $request->in_hospital_price,
            'can_work_in_home_visit' => $request->can_work_in_home_visit,
            'can_work_in_hospital' => $request->can_work_in_hospital,
            'speciality' => $request->speciality,
            'speciality_en' => $request->speciality_en,
            'license' => $request->license,
            'bio' => $request->bio,
            'bio_en' => $request->bio_en,
            'education' => "",
            'experience' => "",
            'emergency_online_price' => 0,
            'emergency_home_visit_price' => 0,
            'online_price' => 0,
            'can_work_emergency_online' => 0,
            'can_work_emergency_home_visit' => 0,
            'can_work_online' => 0,
        ]);
        DB::commit();
//        toastr()->success(trans('global.update_success'), ['timeOut' => 20000, 'closeButton' => true]);
        return response()->json(['status' => true, 'msg' => trans('global.update_success')]);
    }

    public function show($doctorId)
    {
        $data = $this->showTrait($doctorId);
        return view('lab.doctor.show', $data);
    }

    public function destroy($doctorId)
    {
        return $this->destroyTrait($doctorId);
    }


    public function editScheduleOutside($doctorId)
    {
        $hospitalId = auth()->user()->id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($hospitalId)->findOrFail($doctorId);
        if ($data['doctor']) {
            $myWorkSchedule = WorkSchedule::query()->doctorSchedule($data['doctor']['id'])->get();
            $data['drWorkSchedule'] = WorkScheduleResource::jsonFormat($myWorkSchedule);
            return view('lab.doctor.editScheduleOutside', $data);
        }
        return redirect()->back();
    }

    public function updateScheduleOutside(Request $request, $doctorId)
    {
        try {
            $hospitalId = auth()->user()->id;
            $doctor = User::query()->whereDoctorInHospital($hospitalId)->findOrFail($doctorId);
            if ($doctor) {
                $hours = staticHorses();
                $days = staticDays();
                $request_days = array_keys(($request['days']));

                if ($days != $request_days) {
                    return sendError(trans('global.check_the_days_entered'), '');
                } else {
                    DB::beginTransaction();
                    $workSchedule = WorkSchedule::query()->doctorSchedule($doctorId)->pluck('id')->toArray();
                    WorkScheduleHours::query()->whereIn('work_schedule_id', $workSchedule)->forceDelete();
                    WorkSchedule::query()->doctorSchedule($doctorId)->forceDelete();

                    foreach ($request->days as $day_name => $obj) {
                        $doctorWorkSchedule = WorkSchedule::query()->updateOrCreate([
                            'doctor_id' => $doctorId,
                            'day_name' => $day_name,
                            'active' => $obj['active'],
                        ]);
                        if (!empty($obj['work_hours'])) {
                            foreach ($obj['work_hours'] as $hour) {
                                if (!in_array($hour, $hours)) {
                                    return sendError(trans('global.some_hour_not_correct'), [null]);
                                }
                                WorkScheduleHours::query()->updateOrCreate([
                                    'work_schedule_id' => $doctorWorkSchedule->id,
                                    'hour' => $hour,
                                ]);
                            }
                        }
                    }
                    DB::commit();
                }
                return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return sendError(trans('global.some_error'), [null]);
        }
    }

    public function editScheduleInside($doctorId)
    {
        $hospitalId = auth()->user()->id;
        $data['doctor'] = User::query()->WhereDoctorInHospital($hospitalId)->findOrFail($doctorId);
        if ($data['doctor']) {
            $myWorkSchedule = ScheduleInHospital::query()->doctorSchedule($data['doctor']['id'])->get();
            $data['drWorkSchedule'] = WorkScheduleResource::jsonFormat($myWorkSchedule);
            return view('lab.doctor.editScheduleInside', $data);
        }
        return redirect()->back();
    }

    public function updateSchedulInside(Request $request, $doctorId)
    {
        try {
            $hospitalId = auth()->user()->id;
            $doctor = User::query()->whereDoctorInHospital($hospitalId)->findOrFail($doctorId);
            if ($doctor) {
                $hours = staticHorses();
                $days = staticDays();
                $request_days = array_keys(($request['days']));

                if ($days != $request_days) {
                    return sendError(trans('global.check_the_days_entered'), '');
                } else {
                    DB::beginTransaction();
                    $workSchedule = ScheduleInHospital::query()->doctorSchedule($doctorId)->pluck('id')->toArray();
                    ScheduleHourInHospital::query()->whereIn('work_schedule_id', $workSchedule)->forceDelete();
                    ScheduleInHospital::query()->doctorSchedule($doctorId)->forceDelete();

                    foreach ($request->days as $day_name => $obj) {
                        $doctorWorkSchedule = ScheduleInHospital::query()->updateOrCreate([
                            'doctor_id' => $doctorId,
                            'day_name' => $day_name,
                            'active' => $obj['active'],
                        ]);
                        if (!empty($obj['work_hours'])) {
                            foreach ($obj['work_hours'] as $hour) {
                                if (!in_array($hour, $hours)) {
                                    return sendError(trans('global.some_hour_not_correct'), [null]);
                                }
                                ScheduleHourInHospital::query()->updateOrCreate([
                                    'work_schedule_id' => $doctorWorkSchedule->id,
                                    'hour' => $hour,
                                ]);
                            }
                        }
                    }
                    DB::commit();
                }
                return response()->json(['status' => true, 'msg' => trans('global.create_success')]);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return sendError(trans('global.some_error'), [null]);
        }
    }
}
