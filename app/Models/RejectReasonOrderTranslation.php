<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RejectReasonOrderTranslation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reject_reason_order_translations';
    protected $fillable = ['description'];

}
