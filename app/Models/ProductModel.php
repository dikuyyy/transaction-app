<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;


    protected $table = 'products';
    protected $guarded = [];

    public function product_tags() {
        return $this->hasMany(ProductTagModel::class, 'product_id', 'id');
    }

    public function transaction_details() {
        return $this->hasMany(TransactionDetailModel::class, 'product_id', 'id');
    }
}
