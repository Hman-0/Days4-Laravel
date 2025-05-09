@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="container py-5">
    <form action="{{ route('courses.index') }}" method="GET" class="mb-5">
        <div class="input-group shadow-lg rounded-pill">
            <input type="text" 
                   name="q" 
                   class="form-control rounded-pill-start" 
                   placeholder="Tìm kiếm khóa học..."
                   value="{{ request('q') }}">
            <button class="btn btn-primary rounded-pill-end px-4" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    @if(request()->has('q'))
        <div class="alert alert-info mb-4">
            Tìm thấy {{ $courses->count() }} kết quả cho "<strong>{{ request('q') }}</strong>"
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Danh Mục Khóa Học</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-lg btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i>Tạo Khóa Học Mới
        </a>
    </div>

    @if($courses->isEmpty())
        <div class="alert alert-warning">
            Không tìm thấy kết quả phù hợp
        </div>
    @else
        <div class="row g-4">
            @foreach($courses as $course)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-hover h-100">
                <div class="card-img-top position-relative overflow-hidden">
                    <img src="https://picsum.photos/400/250?random={{ $loop->index }}" 
                         class="img-fluid" 
                         alt="{{ $course->title }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="badge-overlay">
                        <span class="badge bg-warning text-dark rounded-pill">
                            <i class="fas fa-book-open me-2"></i>{{ $course->lessons_count }} bài
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <a href="{{ route('profile.show', $course->user) }}" class="text-decoration-none hover-opacity">
                            <img src="{{ $course->user->profile->avatar_url }}" 
                                 class="rounded-circle me-2" 
                                 width="32" 
                                 alt="{{ $course->user->name }}">
                            <small class="text-muted">{{ $course->user->name }}</small>
                        </a>
                    </div>
                    
                    <h5 class="card-title fw-bold text-truncate">{{ $course->title }}</h5>
                    <p class="card-text text-muted line-clamp-3" style="--line-clamp: 3;">
                        {{ $course->description }}
                    </p>
                </div>

                <div class="card-footer bg-transparent border-0 d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2">
                        <span class="badge bg-info rounded-pill">
                            <i class="fas fa-comments me-1"></i>{{ $course->comments_count }}
                        </span>
                    </div>
                    <a href="{{ route('courses.show', $course) }}" 
                       class="btn btn-primary btn-sm rounded-pill px-3">
                        Xem chi tiết <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<style>
    .shadow-hover {
        transition: all 0.3s ease;
        border-radius: 1rem;
    }
    .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .badge-overlay {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: var(--line-clamp);
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection