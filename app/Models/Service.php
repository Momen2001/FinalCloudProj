<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'services';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title', 'description', 'instructions', 'include'];


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
        return asset('storage/services/' . $value);
    }

    public function hospitalServices(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'hospital_services', 'hospital_id', 'service_id');
    }

    function mainService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MainService::class, 'main_service_id', 'id');
    }

    function scopeWhereMainService($q, $mainServicesId)
    {
        return $q->where('main_service_id', $mainServicesId);

    }

    function ScopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

}









