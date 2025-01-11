<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'educations';
    protected $with = ['translations'];

    protected $translatedAttributes = ['details','degree','specialization','department','university'];

    protected $guarded = [];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }


    public function scopeWhereDoctorFollowHospital($qq, $hospitalId)
    {
        $qq->whereHas('doctor', function ($doctor) use ($hospitalId) {
            $doctor->whereHas('doctorSetting', function ($doctorSetting) use ($hospitalId) {
                $doctorSetting->where('hospital_id', $hospitalId);
            });
        });
    }

    public function scopeWhereDoctorId($qq, $doctorId)
    {
        $qq->where('doctor_id', $doctorId);
    }
}
