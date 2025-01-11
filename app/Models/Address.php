<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{

    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'addresses';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title', 'description'];


    protected $fillable = [
        'id',
        'latitude',
        'longitude',
        'user_id',
        'status',
    ];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePatientAddress($query)
    {
        return $query->where('user_id',auth()->user()->id);
    }


}
