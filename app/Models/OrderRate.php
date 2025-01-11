<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderRate extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'order_rates';
    protected $guarded = [''];


}
