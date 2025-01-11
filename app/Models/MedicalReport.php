<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalReport extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;


    protected $table = 'medical_reports';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title', 'description'];
    protected $guarded = [''];
    protected $hidden = ['translations'];


    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'patient_id', 'id');
    }


    public function medicalRecordGalleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MedicalReportGallery::class, 'medical_report_id', 'id');
    }

    public

    function reportType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ReportType::class, 'type', 'id');
    }

    public function scopeWherePatientId($q, $patientId)
    {
        return $q->where('patient_id', $patientId);
    }

}








