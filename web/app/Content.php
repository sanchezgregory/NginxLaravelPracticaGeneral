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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function isLast($id)
    {
        $content = Content::findOrFail($id);
        $last = Content::get()->last();

        if ($content->id == $last->id) {
            return true;
        }
        return false;
    }

    public function hasImage(Content $content)
    {
        if (count($content->images) > 0) return true;
        return false;
    }
}
