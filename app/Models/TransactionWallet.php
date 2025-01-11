<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionWallet extends Model
{

    use HasFactory;
    use Auditable;
    use SoftDeletes;

    protected $table = 'transaction_wallets';
    protected $guarded = [];


    public function wallet(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WalletPatient::class, 'wallet_id', 'id');
    }

    public function getStatusName()
    {
        if ($this->status_transaction == 'success') {
            return trans('global.success');
        }  else {
            return trans('global.failed');
        }
    }
}
