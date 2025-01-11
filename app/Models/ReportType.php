<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportType extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;


    protected $table = 'report_types';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title'];
    protected $guarded = [''];
    protected $hidden = ['translations'];

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/default.png');
        }
        return asset('storage/reportType/' . $value);
    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

}













