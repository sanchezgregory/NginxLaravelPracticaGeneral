<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    private $c = 1;

    protected $fillable = ['title', 'path', 'content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function storeImage(Request $request, Content $content)
    {
        $c = 0;
        foreach($request->files as $key => $image) {

            $this->storeImageIndividually($request, $image, $content, ++$c);

        }

        return true;
    }

    public function deleteImageIfExist($imgName, $folder = null)
    {

        $exts = [
            0 => 'jpg',
            1 => 'png',
            2 => 'jpeg'
        ];

        foreach($exts as $ext) {

            if ((file_exists( public_path() . '/storage/' . $folder . $imgName . '.' . $ext))) {

                Storage::delete($folder . $imgName. "." .$ext);

            }

        }
    }

    public function storeImageIndividually($request, $image, $content = null, $key = null)
    {
        if (isset($image->id)) {

            $ext = $request->file('image1')->getClientOriginalExtension();
            $imgName = $image->content->curse->id . "-" . $image->content->id . "-" .$image->id. "." . $ext;

            $image->title = $request->descripcion1;
            $image->path = "contents/".$imgName;
            $image->save();

            $request->file('image1')->storeAs('contents', $imgName,'public');

        } else {

            $img = "image".$key;
            $ext = $request->file($img)->getClientOriginalExtension();

            $desc = "descripcion".$key;

            $image = Image::create([
                'content_id' => $content->id,
                'title' => $request->$desc,
            ]);

            $imgName = $image->content->curse->id . "-" . $image->content->id . "-" .$image->id. "." . $ext;

            $image->path = "contents/".$imgName;
            $image->save();

            // $key tiene el nombre del file (image1, image2, image3....)
            $request->file($img)->storeAs('contents', $imgName,'public');
        }

    }
}
