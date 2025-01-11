<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSchedule extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'work_schedules';
    protected $guarded = [''];


    function workScheduleHours(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WorkScheduleHours::class);
    }

    function doctor(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'doctor_id', 'id');
    }

    function scopeMySchedule($query)
    {
        return $query->where('doctor_id', auth()->user()->id);
    }

    function scopeDoctorSchedule($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }


    function scopeDoctorActiveSchedule($query,$doctorId)
    {
        return $query->where('doctor_id', $doctorId)->where('active',1);
    }
}














