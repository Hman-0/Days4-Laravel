@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-top">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-plus-circle me-2"></i>Tạo bài học mới - {{ $course->title }}
                    </h4>
                </div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('lessons.store', $course) }}">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Tên bài học">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Tên bài học
                            </label>
                            @error('title')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label fw-medium text-secondary">
                                <i class="fas fa-file-alt me-2"></i>Nội dung bài học
                            </label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" 
                                      name="content" 
                                      rows="6"
                                      placeholder="Nhập nội dung chi tiết...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tags" class="form-label fw-medium text-secondary">
                                <i class="fas fa-tags me-2"></i>Tags
                                <small class="text-muted">(phân cách bằng dấu phẩy)</small>
                            </label>
                            <input type="text" 
                                   class="form-control @error('tags') is-invalid @enderror" 
                                   id="tags" 
                                   name="tags" 
                                   value="{{ old('tags') }}"
                                   placeholder="Ví dụ: PHP, Laravel, React">
                            @error('tags')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary px-4 rounded-pill">
                                <i class="fas fa-times me-2"></i>Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-gradient-primary px-4 rounded-pill">
                                <i class="fas fa-save me-2"></i>Lưu bài học
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(45deg, #3b82f6, #6366f1);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }
    
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }
    
    .shadow-hover {
        transition: all 0.3s ease;
    }
</style>
@endsection