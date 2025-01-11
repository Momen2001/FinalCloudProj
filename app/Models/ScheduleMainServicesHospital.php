<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleMainServicesHospital extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'schedule_main_services_hospitals';
    protected $guarded = [''];


    function workScheduleHours(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ScheduleHourMainServicesHospital::class);
    }

    function hospital(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'hospital_id', 'id');
    }

    function scopeMyScheduleMainServices($query,$hospitalId,$mainServiceId)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id',$mainServiceId);
    }

    function scopeHospitalMainServiceActiveSchedule($query,$hospitalId,$mainServiceId)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id',$mainServiceId)->where('active',1);
    }
    function scopeHospitalMainServiceSchedule($query,$hospitalId,$mainServiceId,$day_name)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id',$mainServiceId)->where('day_name',$day_name);
    }
}
