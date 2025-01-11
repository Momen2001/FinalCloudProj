<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'experience_translations';
    protected $fillable = [ 'company', 'details' ,'position'];

}
