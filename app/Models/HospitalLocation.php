<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalLocation extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;
    use Translatable;

    protected $table = 'hospital_locations';
    protected $guarded = [];
    protected $with = ['translations'];
    protected $translatedAttributes = ['location'];
    protected $hidden = ['translations'];


    public function hospital(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'hospital_id', 'id');
    }

    public function scopeWhereHospitalId($qq, $hospitalId)
    {
        return $qq->where('hospital_id', $hospitalId);
    }

}



