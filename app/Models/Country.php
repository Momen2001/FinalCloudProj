<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{


    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'countries';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title'];
    protected $hidden = ['translations'];
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getFlagAttribute($value): string
    {
        if (!$value) {
            return asset('assets/man.png');
        }
        return asset('storage/flags/' . $value);

    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

    function ScopeActive()
    {
        return $this->where('status', 1);
    }

}







