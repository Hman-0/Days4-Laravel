@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white h4">
                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập hệ thống
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login-post') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email"
                                   required
                                   autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password"
                                   required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection