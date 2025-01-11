<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'notification_translations';
    protected $fillable = ['body','title'];

}
