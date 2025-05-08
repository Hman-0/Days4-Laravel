@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tạo bài học mới cho khóa học: {{ $course->title }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('lessons.store', $course) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Tên bài học</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="5">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags (phân cách bằng dấu phẩy)</label>
                            <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                   id="tags" name="tags" value="{{ old('tags') }}">
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Tạo bài học</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection