<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $lessons = $tag->lessons()->with('course')->get();

        return view('tags.show', compact('tag', 'lessons'));
    }
}