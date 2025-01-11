<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalMainService extends Pivot
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'hospital_main_services';
    protected $guarded = [''];


    public function scopeHospitalHasMainService($query, $hospitalId, $mainServiceId)
    {
        return $query->where('hospital_id', $hospitalId)->where('main_service_id', $mainServiceId);
    }


    public function mainService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainService::Class, 'main_service_id', 'id');
    }


}


