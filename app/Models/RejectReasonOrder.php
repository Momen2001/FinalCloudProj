<?php

namespace App\Models;

use App\Traits\Auditable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RejectReasonOrder extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;
    use Translatable;

    protected $table = 'reject_reason_orders';
    protected $guarded = [];
    protected $with = ['translations'];
    protected $translatedAttributes = [ 'description' ];
    protected $hidden = ['translations'];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}



