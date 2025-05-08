<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['user', 'lessons.tags'])
            ->withCount(['lessons', 'comments'])
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['user', 'lessons.tags', 'comments.user']);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course = Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => 1, // Tạm thời gán user_id = 1
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'Khóa học đã được tạo thành công');
    }
}