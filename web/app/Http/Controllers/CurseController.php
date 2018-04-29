<?php

namespace App\Http\Controllers;

use App\Curse;
use Illuminate\Http\Request;

class CurseController extends Controller
{
    public function index()
    {
        $curses = Curse::with('contents')->get();

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
        return view('contents.create');
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

        return redirect()->route('contents.index', compact($curse))->with('status', 'Curso '. $curse->title.', creado satisfactoriamente');

    }

    public function show($id)
    {
        $curse = Curse::with('contents')->findOrFail($id);
        return view('curses.show', compact('curse'));
    }
}
