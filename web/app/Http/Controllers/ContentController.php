<?php

namespace App\Http\Controllers;

use App\Content;
use App\Curse;
use App\Image;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $curses = Content::with('contents')->all();

        return view('contents.index', compact('curses'));
    }

    public function create($id)
    {
        $curse = Curse::findOrFail($id);

        return view('contents.create', compact('curse'));
    }

    public function store(Request $request, Curse $curse)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:50',
            'url' => 'required|string',
            'body' => 'required|string|min:10|max:500',
            'image' => 'sometimes|file'
        ]);

        $content = Content::create([
            'title' => $request->title,
            'url' => $request->url,
            'body' => $request->body,
            'curse_id' => $curse->id,
        ]);

        // if ($request->hasFile('image')) { // para una sola imagen
        if (count($request->files) > 0) {    // para mas de una imagen

            $image = new Image();
            $image->storeImage($request, $content);

        }

        return redirect()->route('curses.show', $curse)->with('status', 'Contenido agregado satisfactoriamente');

    }

    public function show(Content $content)
    {

        return view('contents.show', compact('content'));
    }
}
