@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-4">Tìm kiếm</h3>
                    <form action="{{ route('search') }}" method="GET">
                        <div class="mb-3">
                            <input type="text" name="q" class="form-control form-control-lg" 
                                   placeholder="Tìm khóa học, bài học hoặc tag..." 
                                   value="{{ request('q') }}">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="type[]" 
                                       value="courses" id="checkCourses" 
                                       {{ in_array('courses', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkCourses">Khóa học</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="type[]" 
                                       value="lessons" id="checkLessons"
                                       {{ in_array('lessons', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkLessons">Bài học</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="type[]" 
                                       value="tags" id="checkTags"
                                       {{ in_array('tags', request('type', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="checkTags">Tags</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </form>
                </div>
            </div>

            @if(request('q'))
                <div class="search-results mt-4">
                    @if($courses ?? false)
                        <h4>Khóa học</h4>
                        <div class="list-group mb-4">
                            @forelse($courses as $course)
                                <a href="{{ route('courses.show', $course) }}" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">{{ $course->title }}</h5>
                                    <p class="mb-1">{{ Str::limit($course->description, 100) }}</p>
                                    <small>Giảng viên: {{ $course->user->name }}</small>
                                </a>
                            @empty
                                <div class="list-group-item">Không tìm thấy khóa học nào</div>
                            @endforelse
                        </div>
                    @endif

                    @if($lessons ?? false)
                        <h4>Bài học</h4>
                        <div class="list-group mb-4">
                            @forelse($lessons as $lesson)
                                <a href="{{ route('lessons.show', $lesson) }}" class="list-group-item list-group-item-action">
                                    <h5 class="mb-1">{{ $lesson->title }}</h5>
                                    <p class="mb-1">{{ Str::limit($lesson->content, 100) }}</p>
                                    <small>Thuộc khóa học: {{ $lesson->course->title }}</small>
                                </a>
                            @empty
                                <div class="list-group-item">Không tìm thấy bài học nào</div>
                            @endforelse
                        </div>
                    @endif

                    @if($tags ?? false)
                        <h4>Tags</h4>
                        <div class="mb-4">
                            @forelse($tags as $tag)
                                <a href="{{ route('tags.show', $tag) }}" class="badge bg-secondary text-decoration-none me-2">
                                    {{ $tag->name }}
                                </a>
                            @empty
                                <p>Không tìm thấy tag nào</p>
                            @endforelse
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection