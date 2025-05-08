<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Tag;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $types = $request->input('type', ['courses', 'lessons', 'tags']);

        $data = [];

        if (in_array('courses', $types)) {
            $data['courses'] = Course::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->with('user')
                ->get();
        }

        if (in_array('lessons', $types)) {
            $data['lessons'] = Lesson::whereHas('tags', function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->withCount('comments')
                ->groupBy('id')
                ->having('comments_count', '>', 3)
                ->with('course')
                ->get();
        }

        if (in_array('tags', $types)) {
            $data['tags'] = Tag::where('name', 'like', "%{$query}%")->get();
        }

        return view('welcome', $data);
    }
}