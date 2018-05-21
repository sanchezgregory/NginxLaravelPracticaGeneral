<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title'];

    public static function addNewTags($tags)
    {
        $tags = array_filter($tags, function($value){
            return !is_numeric($value);
        });

        $tags = array_unique($tags);

        array_walk($tags, 'trim');

        $tags = array_filter($tags, function($value){
            return strlen($value) >= 2;
        });

        $existingTags = static::whereIn('title', $tags)->pluck('title')->toArray();

        $newTags = array_diff($tags, $existingTags);

        foreach($newTags as $tag){

            static::create(['title' => $tag]);

        }
    }

    public function curses()
    {
        return $this->morphToMany(Curse::class, 'taggable');
    }

    public function contents()
    {
        return $this->morphToMany(Content::class, 'taggable');
    }
}
