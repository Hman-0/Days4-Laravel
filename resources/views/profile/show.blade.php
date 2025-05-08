@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $user->profile?->avatar_url ?? 'https://via.placeholder.com/150' }}" 
                             alt="Avatar" class="rounded-circle" width="150">
                        <h3 class="mt-3">{{ $user->name }}</h3>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Tiểu sử</h5>
                        <p>{{ $user->profile?->bio ?? 'Chưa có thông tin' }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Ngày sinh</h5>
                        <p>{{ $user->profile?->birthday ? $user->profile->birthday->format('d/m/Y') : 'Chưa cập nhật' }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Khóa học đã tạo</h5>
                        <div class="list-group">
                            @forelse($user->courses as $course)
                                <a href="{{ route('courses.show', $course) }}" class="list-group-item list-group-item-action">
                                    {{ $course->title }}
                                </a>
                            @empty
                                <p class="text-muted">Chưa có khóa học nào</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Chỉnh sửa hồ sơ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection