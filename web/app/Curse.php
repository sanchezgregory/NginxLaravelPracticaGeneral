<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curse extends Model
{
    protected $fillable = ['title', 'premium', 'lessons'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function deleteImageCurseIfExist($name)
    {
        $exts = [
            0 => 'jpeg',
            1 => 'jpg',
            2 => 'png'
        ];

        foreach ($exts as $ext) {

            $file = 'storage/curses/' . $name . "." . $ext;

            if (\File::exists(public_path($file))) {

                \File::delete($file);
                return true;
            }
        }

        return false;

    }

    public function isLast(Curse $curse)
    {
        $last = Curse::get()->last();
        if($curse->id == $last->id) return true;
        return false;
    }
}
