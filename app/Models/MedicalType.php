<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalType extends Model
{

    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'medical_types';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title'];
    protected $guarded = [''];
    protected $hidden = ['translations'];

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/default.png');
        }
        return asset('storage/medicalType/' . $value);
    }

    function ScopeActive()
    {
        return $this->where('status', 1);
    }
    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

    public function GetParent()
    {
        return $this->parent == 0 ? trans('cruds.main') : MedicalType::query()->find($this->parent)->title;
    }

}













