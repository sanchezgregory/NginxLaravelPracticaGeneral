<?php

namespace App\Http\Controllers;

use App\Content;
use App\Curse;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request, Content $content)
    {

        $request->validate([
            'descripcion1' => 'required|string|min:1|max:1000',
            'image1' => 'required|file'
        ]);

        if ($request->files) {

            $image = new Image();
            $image->storeImage($request, $content);
            if ($image) return redirect()->route('contents.show', $content)->with('status', 'Imagen agregada satisfactoriamente');
        }

    }

    public function update(Request $request, Image $image)
    {
           $request->validate([
            'descripcion1' => 'required|min:1'
           ]);

           $img = new Image();
           $name = $image->content->curse->id ."-". $image->content->id ."-". $image->id;

           $img->deleteImageIfExist($name, 'contents/');

           $img->storeImageIndividually($request, $image);

           return redirect()->route('contents.show', $image->content)->with('status', 'Imagen actualizada');

    }
}
