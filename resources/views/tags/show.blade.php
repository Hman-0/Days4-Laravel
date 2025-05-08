@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kết quả cho tag: <span class="badge bg-secondary">{{ $tag->name }}</span></h2>

    <h4 class="mt-4">Các bài học có tag này</h4>
    <div class="list-group mb-4">
        @forelse($lessons as $lesson)
            <a href="{{ route('lessons.show', $lesson) }}" class="list-group-item list-group-item-action">
                <h5 class="mb-1">{{ $lesson->title }}</h5>
                <p class="mb-1">{{ Str::limit($lesson->content, 100) }}</p>
                <small>Thuộc khóa học: {{ $lesson->course->title }}</small>
            </a>
        @empty
            <div class="list-group-item">Không có bài học nào với tag này.</div>
        @endforelse
    </div>
</div>
@endsection