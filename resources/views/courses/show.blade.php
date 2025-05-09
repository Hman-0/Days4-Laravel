@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-6 fw-bold text-primary">{{ $course->title }}</h1>
                        <a href="{{ route('lessons.create', $course) }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Thêm bài học
                        </a>
                    </div>

                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $course->user->profile->avatar_url }}" 
                             class="rounded-circle me-3" 
                             width="48" 
                             alt="{{ $course->user->name }}">
                        <div>
                            <p class="mb-0 fw-medium">Giảng viên: {{ $course->user->name }}</p>
                            <small class="text-muted">Ngày tạo: {{ $course->created_at->format('d/m/Y') }}</small>
                        </div>
                    </div>

                    <p class="lead text-secondary mb-4">{{ $course->description }}</p>

                    <div class="d-flex gap-2 mb-4">
                        <span class="badge bg-info rounded-pill">
                            <i class="fas fa-book-open me-1"></i>{{ $course->lessons_count }} bài học
                        </span>
                        <span class="badge bg-success rounded-pill">
                            <i class="fas fa-comments me-1"></i>{{ $course->comments_count }} bình luận
                        </span>
                    </div>
                </div>
            </div>

            <h3 class="fw-bold mb-4">Danh sách bài học</h3>
            <div class="row g-3">
                @foreach($course->lessons as $lesson)
                <div class="col-12">
                    <div class="card border-0 shadow-hover h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="w-75">
                                    <h5 class="card-title fw-medium">
                                        <a href="{{ route('lessons.show', $lesson) }}" 
                                           class="text-decoration-none text-dark">
                                            {{ $lesson->title }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted text-truncate-2 mb-2">
                                        {{ $lesson->content }}
                                    </p>
                                    <div class="d-flex gap-2">
                                        @foreach($lesson->tags as $tag)
                                        <span class="badge bg-light text-dark border rounded-pill">
                                            #{{ $tag->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    {{ $lesson->comments_count }} <i class="fas fa-comment ms-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

           
            </div>
        </div>
    </div>
</div>

<style>
    .shadow-hover {
        transition: all 0.3s ease;
    }
    .shadow-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection