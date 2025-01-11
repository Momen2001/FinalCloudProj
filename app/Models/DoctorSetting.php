<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSetting extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'doctor_settings';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function doctor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        //doctor role
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function hospital(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'hospital_id', 'id')->withTrashed();
    }

    public function yearsOfExperience()
    {
        return \Carbon\Carbon::parse($this->experience_start_work)->diff(\Carbon\Carbon::now())->format('%y Y');
    }

    public function getTranslationBio()
    {
        if (get_default_lang() == "ar") {
            return $this->bio;
        } else {
            return $this->bio_en;
        }
    }
    public function getTranslationSpeciality()
    {
        if (get_default_lang() == "ar") {
            return $this->speciality;
        } else {
            return $this->speciality_en;
        }
    }

    public function scopeWhereCanWorkInHospital($query)
    {
        return $query->where('can_work_in_hospital', 1);
    }


}
