<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'advertisements';
    protected $with = ['translations'];

    protected $translatedAttributes = ['title','description','btn_text'];


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
            return asset('assets/advertisements_default.png');
        }
        return asset('storage/advertisements/' . $value);
    }
}
