<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalSession extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'medical_sessions';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title', 'description'];

    protected $guarded = [];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/default.png');
        }
        return asset('storage/medicalSession/' . $value);
    }

    public function scopeWhereServiceId($qq, $value)
    {
        return $qq->where('service_id', $value);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }


}





