<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['title', 'source', 'path', 'content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
