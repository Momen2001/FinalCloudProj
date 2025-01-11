<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletPatient extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'wallet_patients';
    protected $guarded = [''];


    public function transactionWallet(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransactionWallet::class, 'wallet_id', 'id');
    }
    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

}
