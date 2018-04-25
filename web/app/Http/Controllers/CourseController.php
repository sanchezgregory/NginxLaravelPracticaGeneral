<?php

namespace App\Http\Controllers;

use App\Curse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $curses = Curse::all();

        return view('5p4/index', compact('curses'));

    }
}
