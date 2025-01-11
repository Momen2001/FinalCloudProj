<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainServiceTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'main_service_translations';
    protected $fillable = ['title'];

}
