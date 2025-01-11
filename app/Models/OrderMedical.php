<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderMedical extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'order_medicals';

    protected $guarded = [''];

    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/default.png');
        }
        return asset('assets/media/main-services/' . $value);
    }


}











