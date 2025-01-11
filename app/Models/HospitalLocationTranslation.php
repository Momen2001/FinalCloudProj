<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalLocationTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hospital_location_translations';
    protected $fillable = [ 'location'];

}
