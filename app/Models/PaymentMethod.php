<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory;
    use Auditable;
    use Translatable;
    use SoftDeletes;

    protected $table = 'payment_methods';
    protected $with = ['translations'];
    protected $translatedAttributes = ['title'];


    protected $guarded = [];

    protected $hidden = ['translations'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const PAYMENT_KEY = [
        'PaymentOnline' => 1,
        'PayByHand' => 2,
        'Tamara' => 3,
    ];

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }

    function scopeActive()
    {
        return $this->where('status', 1);
    }
    function scopeIsOnline()
    {
        return $this->where('is_online', 1);
    }

    function scopeWhereNotInPayByHand()
    {
        return $this->where('id', '!=', self::PAYMENT_KEY['PayByHand']);
    }
    public function getPhotoAttribute($value)
    {
        if (!$value) {
            return asset('assets/payment.png');
        } elseif ($this->id == self::PAYMENT_KEY['PaymentOnline']) {
            return asset('assets/online-payment.png');
        } elseif ($this->id == self::PAYMENT_KEY['PayByHand']) {
            return asset('assets/pay-by-hand.jpg');
        }elseif ($this->id == self::PAYMENT_KEY['Tamara']) {
            return asset('assets/Tamara.jpeg');
        }
    }


}
