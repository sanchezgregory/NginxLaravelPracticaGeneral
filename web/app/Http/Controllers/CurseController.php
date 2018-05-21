<?php

namespace App\Http\Controllers;

use App\Curse;
use App\Image;
use App\Tag;
use Illuminate\Http\Request;

class CurseController extends Controller
{
    public function index()
    {
        $curses = Curse::with('contents', 'tags')->get();

        $premiums = $curses->filter(function($curses) {
            return  $curses->premium;
        });

        $normals = $curses->reject(function($curses) {
            return $curses->premium;
        });

        return view('curses.index', compact('curses', 'premiums', 'normals'));
    }

    public function Create()
    {
        return view('curses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:1|string',
            'lessons' => 'required|numeric|min:1|max:64',
            'premium' => 'required|string',
            'image' => 'sometimes|image'
        ]);

        $curse = Curse::create([
            'title' => $request->title,
            'lessons' => $request->lessons,
        ]);

        if (isset($request->premium)) {
            $curse->premium = 1;
        }

        if ($request->hasFile('image')) {

            $ext = $request->image->getClientOriginalExtension();

            $curse->deleteImageCurseIfExist($curse->id);

            $nameImage = $curse->id . "." . $ext;

            $curse->image = $request->file('image')->storeAs('curses', $nameImage, 'public');

            $curse->image = 'curses/' . $nameImage;
            $curse->save();

        }

        return redirect()->route('curses.index')->with('status', 'Curso '. $curse->title.', creado satisfactoriamente');

    }

    public function show($id)
    {
        $curse = Curse::with('contents', 'tags')->findOrFail($id);

        return view('curses.show', compact('curse'));
    }

    public function edit(Curse $curse)
    {
        $tags = Tag::all();
        return view('curses.edit', compact('curse', 'tags'));
    }

    public function update(Request $request, Curse $curse)
    {
        if ($request->hasFile('image1')) {

            if ($curse->image == 'curses/default.jpg') {

                $ext = $request->file('image1')->getClientOriginalExtension();
                $imgName = $curse->id . "." . $ext;
                $curse->image = 'curses/' . $imgName;
                $curse->save();

                $request->file('image1')->storeAs('curses', $imgName, 'public');

            } else {

                $img = new Image();
                $img->deleteImageIfExist($curse->id, 'curses/');

                $ext = $request->file('image1')->getClientOriginalExtension();
                $imgName = $curse->id . "." . $ext;
                
                $curse->image = 'curses/' . $imgName;
                $curse->save();

                $request->file('image1')->storeAs('curses', $imgName, 'public');

            }


        } else {

            $request->validate([
                'title' => 'required|min:5',
                'premium' => 'boolean',
            ]);

            $tags = $request->get('tags');

            Tag::addNewTags($tags);

            $curse->title = $request->title;
            $curse->premium = $request->premium;
            $curse->save();

            $curse->saveTags($tags);

        }

        return redirect()->route('curses.show', $curse)->with('status', 'Curso editado correctamente');

    }

    public function delete(Curse $curse)
    {

    }

    public function storeComment(Request $request, Curse $curse)
    {
        $request->validate([
            'body' => 'required|string|min:5',
        ]);

        $curse->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('curses.show', $curse->id);

    }
}
