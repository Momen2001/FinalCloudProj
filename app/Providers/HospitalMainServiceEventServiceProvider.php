<?php

namespace App\Providers;

use App\Models\HospitalMainService;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class HospitalMainServiceEventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Listen for the 'hospital_main_service.updating' event
        Event::listen('hospital_main_service.updating', function ($hospitalId, $mainServiceId) {
            // Your logic here for updating event
            if (in_array($mainServiceId, [mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic'], mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare']])) {
                HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)
                    ->update(['can_work_out_side' => placeServiceProvided()['out_side_hospital']]);

            } elseif (in_array($mainServiceId, [mainServiceById()['Appointment']])) {
                HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)
                    ->update(['can_work_out_side' => placeServiceProvided()['inside_hospital']]);
            }
        });

        // Listen for the 'hospital_main_service.creating' event
        Event::listen('hospital_main_service.creating', function ($hospitalId, $mainServiceId) {
            // Your logic here for updating event
            if (in_array($mainServiceId, [mainServiceById()['Caregiver'], mainServiceById()['TeleMedicUrgent'], mainServiceById()['TeleMedic'], mainServiceById()['HomeVisitUrgent'], mainServiceById()['HomeCare']])) {
                HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)
                    ->update(['can_work_out_side' => placeServiceProvided()['out_side_hospital']]);

            } elseif (in_array($mainServiceId, [mainServiceById()['Appointment']])) {
                HospitalMainService::query()->hospitalHasMainService($hospitalId, $mainServiceId)
                    ->update(['can_work_out_side' => placeServiceProvided()['inside_hospital']]);
            }
          });
    }
}
