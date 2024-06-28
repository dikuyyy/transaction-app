<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistoryItem extends Model
{
    use HasFactory;

    protected $table = 'transaction_history_items';
    protected $guarded = [];

    public function transactionHistory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransactionHistory::class, 'transaction_history_id', 'id');
    }
}
