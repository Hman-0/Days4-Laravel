<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hệ Thống Đào Tạo Trực Tuyến</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .nav-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .nav-brand-gradient {
            background: linear-gradient(45deg, #00b4d8, #0077b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-scale {
            transition: all 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark nav-glass fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('courses.index') }}">
                <i class="fas fa-brain me-2"></i>
                <span class="nav-brand-gradient">EduHub</span>
            </a>
            
          
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white hover-scale" href="">
                            <i class="fas fa-book-open me-2"></i>Khóa học
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto gap-3">
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-4 hover-scale" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                            </a>
                        </li>
                  
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center py-0" 
                               href="#" 
                               data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->profile->avatar_url }}" 
                                     class="rounded-circle me-2" 
                                     width="36" 
                                     alt="{{ Auth::user()->name }}">
                                <span class="fw-medium">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                                <li>
                                    <a class="dropdown-item rounded-3" href="{{ route('profile.show', Auth::user()) }}">
                                        <i class="fas fa-user-circle me-2"></i>Trang cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item rounded-3" href="{{ route('profile.edit', Auth::user()) }}">
                                        <i class="fas fa-cog me-2"></i>Cài đặt
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider mx-3"></li>
                                <li>
                                    <a class="dropdown-item rounded-3 text-danger" 
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1 mt-5 pt-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white mt-auto py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center text-md-start">
                    <h5 class="mb-3">EduHub</h5>
                    <p>Nền tảng học tập trực tuyến hàng đầu Việt Nam</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5 class="mb-3">Liên hệ</h5>
                    <p>Email: support@eduhub.vn<br>Hotline: 1900 1234</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <div class="d-flex justify-content-center justify-content-md-end gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-tiktok fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    
</form>