<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleHourMainServicesHospital extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'schedule_hour_main_services_hospitals';
    protected $guarded = [''];

    function workSchedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ScheduleMainServicesHospital::class, 'schedule_main_services_hospital_id', 'id')->whereNull('deleted_at');
    }

    function scopeMyHoursWork($query, $hospitalId, $mainServiceId)
    {
        return $query->whereHas('workSchedule', function ($q) use ($hospitalId, $mainServiceId) {
            return $q->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId);
        });
    }

    function scopeHospitalMainServiceHoursWorkWhereDay($query, $dayName, $hospitalId, $mainServiceId)
    {
        return $query->whereHas('workSchedule', function ($q) use ($dayName, $hospitalId, $mainServiceId) {
            return $q->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId)->where('day_name', $dayName);
        });
    }

    function scopeMyHoursWorkWhereInDay($query, $arrayDaysName, $hospitalId, $mainServiceId)
    {
        return $query->whereHas('workSchedule', function ($q) use ($arrayDaysName, $hospitalId, $mainServiceId) {
            return $q->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId)->whereIn('day_name', $arrayDaysName);
        });
    }
}
