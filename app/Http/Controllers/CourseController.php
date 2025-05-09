<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        
        $courses = Course::when($query, function($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%")
                       ->orWhere('description', 'like', "%{$query}%");
            })
            ->withCount(['lessons', 'comments'])
            ->latest()
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
            'description' => 'required|string'
        ]);
    
        // Get authenticated user
        $user = Auth::user();
        
        $course = $user->courses()->create($validated);
    
        return redirect()->route('courses.show', $course)
            ->with('success', 'Khóa học đã được tạo thành công');
    }
}