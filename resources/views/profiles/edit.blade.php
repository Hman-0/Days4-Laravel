@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-3">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="mb-0"><i class="fas fa-user-edit me-2"></i>Cập nhật thông tin</h2>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="avatar-upload">
                            <img src="{{ $profile->avatar_url }}" 
                                 class="rounded-circle shadow mb-3" 
                                 width="200" 
                                 alt="Avatar" 
                                 id="avatarPreview">
                            <div class="mt-3">
                                <input type="file" 
                                       class="form-control" 
                                       name="avatar" 
                                       id="avatarInput"
                                       accept="image/*">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label class="form-label fw-medium">Họ tên</label>
                            <input type="text" 
                                   class="form-control" 
                                   value="{{ $user->name }}" 
                                   disabled>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Mã sinh viên</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="student_id" 
                                   value="{{ old('student_id', $profile->student_id) }}"
                                   placeholder="Nhập mã sinh viên (nếu có)">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Ngày sinh</label>
                            <input type="date" 
                                   class="form-control" 
                                   name="birthday" 
                                   value="{{ old('birthday', $profile->birthday ? $profile->birthday->format('Y-m-d') : '') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium">Giới thiệu bản thân</label>
                            <textarea class="form-control" 
                                      name="bio" 
                                      rows="4"
                                      placeholder="Viết đôi điều về bạn...">{{ old('bio', $profile->bio) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 border-top pt-4">
                    <a href="{{ route('profile.show', $user) }}" 
                       class="btn btn-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-2"></i>Hủy bỏ
                    </a>
                    <button type="submit" 
                            class="btn btn-primary px-4 rounded-pill">
                        <i class="fas fa-save me-2"></i>Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('avatarPreview').src = e.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>
@endsection