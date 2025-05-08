@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2>Chỉnh sửa hồ sơ</h2>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label">Tiểu sử</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" name="bio" rows="3">{{ old('bio', $user->profile?->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="birthday" class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control @error('birthday') is-invalid @enderror" 
                               id="birthday" name="birthday" 
                               value="{{ old('birthday', $user->profile?->birthday?->format('Y-m-d')) }}">
                        @error('birthday')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="avatar_url" class="form-label">URL Ảnh đại diện</label>
                        <input type="url" class="form-control @error('avatar_url') is-invalid @enderror" 
                               id="avatar_url" name="avatar_url" 
                               value="{{ old('avatar_url', $user->profile?->avatar_url) }}">
                        @error('avatar_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection