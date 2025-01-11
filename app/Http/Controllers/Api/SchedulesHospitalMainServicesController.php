<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Traits\ApiPatientValidationTrait;
use App\Models\MainService;
use App\Models\ScheduleHourMainServicesHospital;
use App\Models\ScheduleMainServicesHospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SchedulesHospitalMainServicesController extends Controller
{
    use ApiPatientValidationTrait;

    public function show(Request $request, $hospitalId, $mainServiceId)
    {
        $checkHospital = User::query()->whereHospitalOrLab()->find($hospitalId);
        if (!$checkHospital) {
            return sendError(trans('global.not_hospital_role'), [null]);
        }

        $myWorkSchedule = ScheduleMainServicesHospital::query()->myScheduleMainServices($hospitalId, $mainServiceId)->get();
        $myWorkSchedule = HospitalMainServicesWorkScheduleResource::collection($myWorkSchedule);
        return sendResponse($myWorkSchedule, trans('global.show_data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $hospitalId, $mainServiceId)
    {
        try {
//            $data = json_decode(file_get_contents('php://input'), true);
            $data = $request->except('_token');
            $auth = $hospitalId;
            $hours = staticHorses();
            $days = staticDays();
            $request_days = array_keys($data['days']);

            $checkHospital = User::query()->whereHospitalOrLab()->find($hospitalId);
            if (!$checkHospital) {
                return sendError(trans('global.not_hospital_role'), [null]);
            }
            $mainService = MainService::query()->find($mainServiceId);
            if (!$mainService) {
                return sendError(trans('global.main_service_not_found'), [null]);
            }

            //check hospital work in this main service
            $checkHospitalWorkInService = User::query()->where('id', $hospitalId)->whereHas('hospitalMainServices', function ($q) use ($mainServiceId) {
                return $q->where('main_service_id', $mainServiceId);
            })->first();

            if (!$checkHospitalWorkInService) {
                // if this  hospital not have this service from Table ("hospital_main_services")
                return sendError(trans('global.sorry_this_hospital_does_not_provide_this_service_continue_to_manage_the_application'), [null]);
            }

            if ($days != $request_days) {
                return sendError(trans('global.check_the_days_entered'), '');
            } else {

                DB::beginTransaction();
                $WorkSchedule = ScheduleMainServicesHospital::query()->myScheduleMainServices($hospitalId, $mainServiceId)->pluck('id')->toArray();
                ScheduleHourMainServicesHospital::query()->whereIn('schedule_main_services_hospital_id', $WorkSchedule)->delete();
                ScheduleMainServicesHospital::query()->myScheduleMainServices($hospitalId, $mainServiceId)->delete();

                foreach ($data as $day) {

                    foreach ($day as $day_name => $item) {
                        $hospitalMainServiceWorkSchedule = ScheduleMainServicesHospital::query()->updateOrCreate([
                            'hospital_id' => $auth,
                            'main_service_id' => $mainServiceId,
                            'day_name' => $day_name,
                            'active' => $item['active'],
                        ]);
                        if (!empty($item['work_hours'])) {
                            foreach ($item['work_hours'] as $hour) {
                                if (!in_array($hour, $hours)) {
                                    return sendError(trans('global.some_hour_not_correct'), [null]);
                                }
                                ScheduleHourMainServicesHospital::query()->updateOrCreate([
                                    'schedule_main_services_hospital_id' => $hospitalMainServiceWorkSchedule->id,
                                    'hour' => $hour,
                                ]);
                            }
                        }
                    }
                }
                DB::commit();
            }
            return response()->json(['status' => true, 'msg' => trans('global.update_success')]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return sendError(trans('global.some_error'), [null]);
        }
    }


}











