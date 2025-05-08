@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách khóa học</h2>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tạo khóa học mới
        </a>
    </div>

    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Giảng viên: {{ $course->user->name }}</h6>
                    <p class="card-text">{{ $course->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="badge bg-primary">{{ $course->lessons_count }} bài học</span>
                            <span class="badge bg-secondary">{{ $course->comments_count }} bình luận</span>
                        </div>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-outline-primary">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection