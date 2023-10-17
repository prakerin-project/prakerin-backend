@php use Illuminate\Support\Facades\Auth; @endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="icon" href="{{asset('logo.svg')}}">

    <style>
        .menu-item:hover {
            background-color: #CFE2FF;
            color: #CFE2FF;
        }
        .dropdown-toggle::after {
            margin-left: 6em;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
<div id="app" class="row vw-100">
    <aside class="col-2 d-flex flex-column align-items-center p-0 border" style="width: 300px; height: 100vh">
        <img src="{{ asset('one-logo.svg') }}" alt="logo" width="80px">

        <div class="menu mt-3 rounded w-75">
            <a href="{{url('/dashboard')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3
            align-items-center
        link-underline
        link-underline-opacity-0">
                <h3 class="m-0"><i class="bi bi-house-fill"></i></h3>
                <h5 class="m-0">Dashboard</h5>
            </a>

            <p class="mb-0 mt-3">Menu</p>
            <div class="dropdown">
                <a href="{{url('/dashboard/user')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3
                align-items-center link-underline link-underline-opacity-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <h3 class="m-0"><i class="bi bi-person-fill"></i></h3>
                    <h5 class="m-0">User</h5>
                </a>
                {{-- Dropdwon menu for user --}}
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/siswa') }}">Siswa</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/walas') }}">Wali Kelas</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/kaprog') }}">Kepala Program</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/hubin') }}">Hubin</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/pembimbing') }}">Pembimbing</a></li>
                    <li><a class="dropdown-item" href="{{ url('/dashboard/user/tu') }}">Tata Usaha</a></li>
                  </ul>
            </div>

            <a href="{{url('/dashboard/perusahaan')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3
            align-items-center
        link-underline
        link-underline-opacity-0">
                <h3 class="m-0"><i class="bi bi-building-fill"></i></h3>
                <h5 class="m-0">Perusahaan</h5>
            </a>

            <a href="{{url('/dashboard/prakerin')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center
        link-underline
        link-underline-opacity-0">
                <h3 class="m-0"><i class="bi bi-book-fill"></i></h3>
                <h5 class="m-0">Prakerin</h5>
            </a>

            <a href="{{url('/dashboard/pengajuan')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3
            align-items-center
        link-underline
        link-underline-opacity-0">
                <h3 class="m-0"><i class="bi bi-clipboard2-fill"></i></h3>
                <h5 class="m-0">Pengajuan</h5>
            </a>

            <a href="{{url('/dashboard/monitoring')}}" class="menu-item text-dark py-2 px-2 rounded d-flex gap-3
            align-items-center
        link-underline
        link-underline-opacity-0">
                <h3 class="m-0"><i class="bi bi-display"></i></h3>
                <h5 class="m-0">Monitoring</h5>
            </a>
        </div>
    </aside>
    <div class="col p-0 ">
        <nav class="navbar px-0 navbar-expand-lg navbar-light border-bottom">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item mx-4 d-flex align-items-center">
                                <p class="m-0">Hello,</p>
                                <h1 class="m-auto mx-2"><i class="bi bi-person-circle"></i></h1>
                                <div>
                                    <p class="text-capitalize m-0 text-secondary"></p>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn logout btn-danger" href="">{{ __('Logout') }}</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-3 px-4 container-fluid">
            @include('layouts.flash-message')
            @yield('content')
        </main>
    </div>
</div>

@yield('footer')
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
</script>
</body>
</html>
