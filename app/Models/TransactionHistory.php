<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';
    protected $guarded = [];

    public function transactionHistoryItem(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TransactionHistoryItem::class, 'transaction_history_id', 'id');
    }

    public function failedTransactionHistoryItem(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FailedTransaction::class, 'transaction_history_id', 'id');
    }
}
