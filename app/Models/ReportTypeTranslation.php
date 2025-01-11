<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportTypeTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'report_type_translations';
    protected $fillable = ['title'];

}
