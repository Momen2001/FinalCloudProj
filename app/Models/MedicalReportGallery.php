<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalReportGallery extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'medical_report_galleries';
    protected $guarded = [];

    public function getFileNameAttribute($value): string
    {
        if (!$value) {
            return asset('assets/man.png');
        }
        return asset('storage/medicalMedia/' . $value);
    }
}
