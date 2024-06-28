<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTagModel extends Model
{
    use HasFactory;

    protected $table = 'service_tags';
    protected $guarded = [];

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ServiceModel::class, 'service_id', 'id');
    }

    public function tag(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'tag_id', 'id');
    }
}
