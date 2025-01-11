<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'education_translations';
    protected $fillable = ['details', 'degree', 'specialization', 'department', 'university'];


}
