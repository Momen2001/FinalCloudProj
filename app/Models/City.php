<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'cities';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title'];


    protected $guarded = [];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function scopeWhereCountry($q,$countryId)
    {
        return $q->where('country_id', $countryId);
    }

    function ScopeActive()
    {
        return $this->where('status', 1);
    }

}
