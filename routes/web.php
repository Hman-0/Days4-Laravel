<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
