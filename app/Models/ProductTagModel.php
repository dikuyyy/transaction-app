<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTagModel extends Model
{
    use HasFactory;

    protected $table = 'product_tags';
    protected $guarded = [];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    public function tag(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'tag_id', 'id');
    }
}
