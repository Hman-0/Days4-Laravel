@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h2>{{ $lesson->title }}</h2>
                    <div class="mb-3">
                        @foreach($lesson->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="lesson-content">
                        {{ $lesson->content }}
                    </div>
                </div>
            </div>

            <!-- Phần bình luận -->
            <div class="card">
                <div class="card-body">
                    <h4>Bình luận ({{ $lesson->comments->count() }})</h4>
                    
                    <!-- Form thêm bình luận -->
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                        @csrf
                        <input type="hidden" name="commentable_id" value="{{ $lesson->id }}">
                        <input type="hidden" name="commentable_type" value="App\Models\Lesson">
                        <div class="mb-3">
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" 
                                      rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                    </form>

                    <!-- Danh sách bình luận -->
                    <div class="comments-list">
                        @foreach($lesson->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                                        @if($comment->user_id === Auth::id())
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                                    Xóa
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Về khóa học</h5>
                    <p class="card-text">{{ $lesson->course->title }}</p>
                    <a href="{{ route('courses.show', $lesson->course) }}" class="btn btn-primary">
                        Xem khóa học
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection