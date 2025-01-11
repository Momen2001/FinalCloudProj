<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainService extends Model
{

    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'main_services';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title'];


    protected $fillable = [
        'id',
        'status',
        'photo',
        'is_urgent',
        'filter_develop',
    ];

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
        return asset('assets/media/main-services/' . $value);
    }



    function service(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Service::class, 'main_service_id', 'id');
    }

    function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class, 'main_service_id', 'id');
    }

    function ScopeActive()
    {
        return $this->where('status', 1);
    }

    function checkUrgent()
    {
        return $this->is_urgent == 1 ? trans('cruds.urgent') : trans('cruds.un_urgent');
    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }


    public function hospitalMainServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MainService::class, 'hospital_main_services', 'main_service_id', 'hospital_id')->withPivot('can_work_out_side','time_before_receiving');
    }
}








