<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'service_translations';
    protected $fillable = ['title','description','instructions','include'];

}