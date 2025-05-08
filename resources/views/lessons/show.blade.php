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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="card-text mb-1">{{ $comment->content }}</p>
                                            <small class="text-muted">Bởi {{ $comment->user->name }}</small>
                                        </div>
                                        @if($comment->user_id === Auth::id())
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-primary me-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#editCommentModal{{ $comment->id }}">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </button>
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Sửa bình luận -->
                            @if($comment->user_id === Auth::id())
                                <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Sửa bình luận</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('comments.update', $comment) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <textarea name="content" class="form-control" rows="3">{{ $comment->content }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
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