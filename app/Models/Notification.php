<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'notifications';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title','body'];
    protected $guarded = [''];
    protected $hidden = ['translations'];


    public function checkImage()
    {
        if ($this->image == null) {
            return asset('assets/logo.png');
        }
        return asset('storage/notifications/' . $this->image);
    }

    public function checkImageToNotification()
    {
        if ($this->image == null) {
            return null;
        }
        return asset('storage/notifications/' . $this->image);
    }
    public function scopeMyNotifications($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }



    public function getDateAttribute($value): string
    {
        return Carbon::parse($value)->locale('en')->isoFormat('D MMM Y');
    }
    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }
}













