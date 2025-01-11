<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderServices extends Model
{
    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'order_services';
    protected $guarded = [''];

}






