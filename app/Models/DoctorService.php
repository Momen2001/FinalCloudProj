<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorService extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;
    protected $table = 'doctor_services';
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

    public function service(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Service::class, 'service_id','id');
    }





}




