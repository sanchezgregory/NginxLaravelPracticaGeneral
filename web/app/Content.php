<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['title','body', 'url', 'image', 'curse_id'];

    public function curse()
    {
        return $this->belongsTo(Curse::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
