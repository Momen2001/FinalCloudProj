<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'order_payments';
    protected $guarded = [''];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function scopeOrderById($q)
    {
        return $q->orderBy('id', 'DESC');
    }
}
