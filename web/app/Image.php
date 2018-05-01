<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends Model
{
    protected $fillable = ['title', 'source', 'path', 'content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function storeImage(Request $request, Content $content)
    {

        foreach($request->files as $key => $image) {

            $ext = $image->getClientOriginalExtension();

            $image = Image::create([
                'content_id' => $content->id,
                'source' => $request->source?$request->source:"",
                'title' => $request->imageTitle,
            ]);

            $imgName = $content->curse->id . "-" . $content->id . "-" .$image->id. "." . $ext;

            $image->path = "contents/".$imgName;
            $image->save();

            // $key tiene el nombre del file (image1, image2, image3....)
            $request->file($key)->storeAs('contents', $imgName,'public');

        }

        return true;

    }
}
