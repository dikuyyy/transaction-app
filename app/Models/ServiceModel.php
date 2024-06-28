<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $guarded = [];

    public function service_tags() {
        return $this->hasMany(ServiceTagModel::class, 'service_id', 'id');
    }

    public function transaction_details() {
        return $this->hasMany(TransactionDetailModel::class, 'service_id', 'id');
    }
}
