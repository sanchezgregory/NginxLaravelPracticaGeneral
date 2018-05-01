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
            'title' => 'required|string|min:5|max:50',
            'url' => 'required|string',
            'image' => 'sometimes|file'
        ]);

        if ($request->hasFile('image')) {

            $image = new Image();
            $image->storeImage($request, $content);

            if ($image) return redirect()->route('contents.show', $content)->with('status', 'Imagen agregada satisfactoriamente');
        }

    }
}
