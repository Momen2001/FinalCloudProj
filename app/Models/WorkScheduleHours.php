<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkScheduleHours extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'work_schedule_hours';
    protected $guarded = [''];

    function workSchedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WorkSchedule::class);
    }


    function scopeMyHoursWork($query)
    {
        return $query->whereHas('workSchedule', function ($q) {
            return $q->where('doctor_id', auth()->user()->id);
        });
    }

    function scopeDoctorHoursWorkWhereDay($query, $dayName,$doctorId)
    {
        return $query->whereHas('workSchedule', function ($q) use ($dayName,$doctorId) {
            return $q->where('doctor_id', $doctorId)->where('day_name', $dayName);
        });
    }
    function scopeMyHoursWorkWhereInDay($query, $arrayDaysName,$doctorId)
    {
        return $query->whereHas('workSchedule', function ($q) use ($arrayDaysName,$doctorId) {
            return $q->where('doctor_id', $doctorId)->whereIn('day_name', $arrayDaysName);
        });
    }

}










