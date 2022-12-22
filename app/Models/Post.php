<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // protected $table = ['posts'];

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
