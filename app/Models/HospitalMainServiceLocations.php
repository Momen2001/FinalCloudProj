<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HospitalMainServiceLocations extends Pivot
{
    use HasFactory;
    use Auditable;

    protected $table = 'hospital_main_service_locations';
    protected $guarded = [''];


    public function scopeHospitalHasMainService($query, $hospitalId, $mainServiceId)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId);
    }


    public function mainService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainService::Class, 'main_service_id', 'id');
    }


    public function scopeWhereHospitalMainService($query, $hospitalId, $mainServiceId)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId);
    }


}


