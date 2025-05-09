@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-primary text-white py-3 rounded-top">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-book me-2"></i>Tạo khóa học mới
                    </h4>
                </div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('courses.store') }}">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Tên khóa học">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-2"></i>Tên khóa học
                            </label>
                            @error('title')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-medium text-secondary">
                                <i class="fas fa-align-left me-2"></i>Mô tả khóa học
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5"
                                      placeholder="Nhập mô tả chi tiết cho khóa học...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 justify-content-end mt-5">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary px-4 rounded-pill">
                                <i class="fas fa-times me-2"></i>Hủy bỏ
                            </a>
                            <button type="submit" class="btn btn-gradient-primary px-4 rounded-pill">
                                <i class="fas fa-plus me-2"></i>Tạo khóa học
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
</style>
@endsection