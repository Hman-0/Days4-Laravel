@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-top">
                    <h1 class="display-6 fw-bold mb-0">{{ $lesson->title }}</h1>
                </div>
                
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($lesson->tags as $tag)
                        <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                            <i class="fas fa-tag me-1"></i>{{ $tag->name }}
                        </span>
                        @endforeach
                    </div>

                    <article class="lesson-content fs-5 lh-base">
                        {!! nl2br(e($lesson->content)) !!}
                    </article>
                </div>

                <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        <i class="fas fa-clock me-1"></i>{{ $lesson->created_at->diffForHumans() }}
                    </small>
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary rounded-pill dropdown-toggle" 
                                type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog"></i>
                        </button>
                    
                    </div>
                    @endauth
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4 rounded-3">
                <div class="card-body">
                    <h4 class="fw-bold mb-4">
                        <i class="fas fa-comments me-2"></i>Bình luận ({{ $lesson->comments->count() }})
                    </h4>

                    <form action="{{ route('comments.store') }}" method="POST" class="mb-5">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{ $lesson->id }}">
                        <input type="hidden" name="commentable_type" value="App\Models\Lesson">
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        
                        <div class="input-group">
                            <textarea name="content" 
                                      class="form-control rounded-pill-end @error('content') is-invalid @enderror" 
                                      rows="2" 
                                      placeholder="Viết bình luận của bạn..."></textarea>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        @error('content')
                            <div class="text-danger small mt-2">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </form>

                    <div class="comment-section">
                        @foreach($lesson->comments as $comment)
                        <div class="d-flex gap-3 mb-4">
                            <img src="{{ $comment->user->profile->avatar_url }}" 
                                 class="rounded-circle" 
                                 width="48" 
                                 alt="{{ $comment->user->name }}">
                            <div class="flex-grow-1">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0 fw-medium">{{ $comment->user->name }}</h6>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 sticky-top">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-book me-2"></i>Về khóa học
                    </h5>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="{{ $lesson->course->user->profile->avatar_url }}" 
                             class="rounded-circle" 
                             width="48" 
                             alt="{{ $lesson->course->user->name }}">
                        <div>
                            <p class="mb-0 fw-medium">{{ $lesson->course->user->name }}</p>
                            <small class="text-muted">Giảng viên</small>
                        </div>
                    </div>
                    <h6 class="fw-medium">{{ $lesson->course->title }}</h6>
                    <p class="text-muted small">{{ Str::limit($lesson->course->description, 100) }}</p>
                    <a href="{{ route('courses.show', $lesson->course) }}" 
                       class="btn btn-outline-primary w-100 rounded-pill">
                        <i class="fas fa-external-link-alt me-2"></i>Xem khóa học
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .lesson-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }
    .lesson-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }
    .sticky-top {
        top: 1rem;
    }
    .rounded-pill-end {
        border-radius: 50px 0 0 50px !important;
    }
</style>
@endsection