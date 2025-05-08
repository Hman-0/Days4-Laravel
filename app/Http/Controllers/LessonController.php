<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Tag;
class LessonController extends Controller
{
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);

        $lesson = $course->lessons()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tags = array_map('trim', explode(',', $validated['tags']));
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $lesson->tags()->attach($tag->id);
            }
        }

        return redirect()->route('lessons.show', $lesson)
            ->with('success', 'Lesson created successfully');
    }

    public function show(Lesson $lesson)
    {
        $lesson->load(['comments.user', 'tags']);
        return view('lessons.show', compact('lesson'));
    }
}