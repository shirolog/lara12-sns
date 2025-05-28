<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板アプリ</title>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    
    <!-- bootstrap icon cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ route('posts.index') }}">掲示板アプリ</a>
            <div class="ml-auto">
                <ul class="navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none;">
                                @csrf
                            </form>
                            <div class="d-flex">
                                <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.querySelector('#logout-form').submit();">ログアウト</a>
                                <a href="{{ url('/contact') }}" class="nav-link text-white">お問い合わせ</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link text-white">ログイン</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link text-white">新規登録</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="text-center">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="text-center">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      </div>
    @endif

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>