<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title'];

    public function curses()
    {
        return $this->morphToMany(Curse::class, 'taggable');
    }

    public function contents()
    {
        return $this->morphToMany(Content::class, 'taggable');
    }
}
