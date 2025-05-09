
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-3">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="fas fa-user-circle me-2"></i>Thông tin cá nhân</h2>
                <a href="{{ route('profile.edit', $user) }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-edit me-2"></i>Chỉnh sửa
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <img src="{{ $profile->avatar_url ?? asset('images/default-avatar.png') }}" 
                         class="rounded-circle shadow mb-3" 
                         width="200" 
                         alt="{{ $user->name }}">
                    @if($profile->student_id)
                    <div class="badge bg-info text-dark fs-6 rounded-pill px-3">
                        <i class="fas fa-id-card me-2"></i>{{ $profile->student_id }}
                    </div>
                    @endif
                </div>
                
                <div class="col-md-8">
                    <dl class="row fs-5">
                        <dt class="col-sm-3 text-muted">Họ tên:</dt>
                        <dd class="col-sm-9 fw-medium">{{ $user->name }}</dd>

                        <dt class="col-sm-3 text-muted">Email:</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>

                        <dt class="col-sm-3 text-muted">Ngày sinh:</dt>
                        <dd class="col-sm-9">{{ $profile->birthday ? $profile->birthday->format('d/m/Y') : 'Chưa cập nhật' }}</dd>

                        <dt class="col-sm-3 text-muted">Giới thiệu:</dt>
                        <dd class="col-sm-9">{{ $profile->bio ?? 'Chưa có thông tin giới thiệu' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection