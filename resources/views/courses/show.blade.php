@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ $course->title }}</h2>
            <a href="{{ route('lessons.create', $course) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm bài học mới
            </a>
        </div>
        <p class="text-muted">Giảng viên: {{ $course->user->name }}</p>
        <p>{{ $course->description }}</p>

        <h3 class="mt-4">Danh sách bài học</h3>
        <div class="list-group">
            @foreach($course->lessons as $lesson)
            <div class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-1">
                        <a href="{{ route('lessons.show', $lesson) }}" class="text-decoration-none">
                            {{ $lesson->title }}
                        </a>
                    </h5>
                    <small>
                        @foreach($lesson->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </small>
                </div>
                <p class="mb-1">{{ $lesson->content }}</p>
                <small>{{ $lesson->comments_count }} bình luận</small>
            </div>
            @endforeach
        </div>

        <h3 class="mt-4">Bình luận</h3>
        <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="commentable_id" value="{{ $course->id }}">
            <input type="hidden" name="commentable_type" value="App\Models\Course">
            <div class="mb-3">
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" 
                          rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
        </form>

        @foreach($course->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>
                <small class="text-muted">Bởi {{ $comment->user->name }}</small>
            </div>
        </div>
        @endforeach

        @auth
        <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="commentable_id" value="{{ $course->id }}">
            <input type="hidden" name="commentable_type" value="App\Models\Course">
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Gửi bình luận</button>
        </form>
        @endauth
    </div>
</div>
@endsection