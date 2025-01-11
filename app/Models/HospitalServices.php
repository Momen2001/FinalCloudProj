<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalServices extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'hospital_services';
    protected $guarded = [''];

    public function scopeServicesPriceHospital($q, $hospital_id, $service_id)
    {
        return $q->where('hospital_id', $hospital_id)->where('service_id', $service_id)->first()->price;
    }

    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function ScopeGetServicesBelongsToMainService($query, $hospital_id,$mainServiceId)
    {
        return $query->where('hospital_id', $hospital_id)->whereHas('service',function ($qq) use($mainServiceId){
            $qq->where('main_service_id',$mainServiceId);
        });
    }

}












