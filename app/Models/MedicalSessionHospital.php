<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalSessionHospital extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'medical_session_hospitals';
    protected $guarded = [''];

    public function medicalSession(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MedicalSession::class, 'medical_session_id', 'id');
    }


    public function scopeMedicalSessionPriceHospital($q, $hospital_id, $medical_session_id)
    {
        return $q->where('hospital_id', $hospital_id)->where('medical_session_id', $medical_session_id)->first()->price;
    }

    public function scopeWhereHospital($q, $hospital_id)
    {
        return $q->where('hospital_id', $hospital_id);
    }


}
