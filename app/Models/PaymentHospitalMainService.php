<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentHospitalMainService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payment_hospital_main_services';
    protected $guarded = [];


    public function mainService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainService::class, 'main_service_id', 'id');
    }

    public function paymentMethod(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function ScopePaymentMainServiceForHospital($query, $hospital_id, $mainServiceId)
    {
        return $query->where('hospital_id', $hospital_id)->where('main_service_id', $mainServiceId);
    }

    public function ScopeCheckPaymentMainServiceForHospital($query, $hospital_id, $mainServiceId, $paymentMethodId)
    {
        return $query->where('hospital_id', $hospital_id)
            ->where('main_service_id', $mainServiceId)
            ->where('payment_method_id', $paymentMethodId);
    }

    public function ScopeWhereHospital($query, $hospitalId)
    {
        //return all Insurance mainService For some hospital
        return $query->where('hospital_id', $hospitalId);
    }
}
