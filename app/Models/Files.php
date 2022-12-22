<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = [
        'url', 'type', 'mime_type' ,'fileable_id', 'fileable_type',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
