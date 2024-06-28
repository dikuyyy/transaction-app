<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedTransaction extends Model
{
    use HasFactory;

    protected $table = 'failed_transaction';
    protected $guarded = [];

    public function transactionHistory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransactionHistory::class, 'transaction_history_id', 'id');
    }
}
