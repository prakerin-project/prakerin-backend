@php use Illuminate\Support\Facades\Auth; @endphp
<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Script for Iconsax -->
    <script src="https://grxvityhj.github.io/iconsax/script.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akshar&family=Bitter&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset("logo.svg") }}">

    <style>
        #dropdownToggle:hover {
            cursor: pointer;
        }

        #dropdownToggle {
            rotate: 90deg;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        #dropdownList {
            display: none;
        }

        .menu-item:hover {
            background-color: #CFE2FF;
            color: #CFE2FF;
        }

        .dropdown-toggle::after {
            margin-left: 6em;
        }
    </style>

    <!-- Scripts -->
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
</head>

<body class="bg-white">
    <div class="app" style="display: grid; grid-template-columns: auto 1fr">
        <aside class="d-flex flex-column align-items-center p-0 border" style="width: 300px;
    height:100vh">
            <img src="{{ asset("one-logo.svg") }}" alt="logo" width="80px">

            <div class="menu mt-3 rounded w-75">
                <a href="{{ url("/dashboard") }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="bold" stroke-width="1.5" icon="home-1"></i></h3>
                    <h5 class="m-0">Dashboard</h5>
                </a>

                <p class="mb-0 mt-3">Menu</p>

                <div class="dropdown">
                    <div
                        class="d-flex justify-content-between menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <a href="{{ url("/dashboard/user") }}"
                            class="text-dark d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                            <h3 class="m-0"><i class="iconsax" type="bold" icon="user"></i></h3>
                            <h5 class="m-0">User</h5>
                        </a>
                        <div id="dropdownToggle" class="h-100">
                            <span class="fs-4">></span>
                        </div>
                    </div>
                    <ul id="dropdownList" style="list-style: none">
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                href="{{ url("/dashboard/user/siswa") }}">Siswa</a></li>
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0" href="{{ url("/dashboard/user/walas") }}">Wali
                                Kelas</a></li>
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                href="{{ url("/dashboard/user/kaprog") }}">Kepala Program</a>
                        </li>
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                href="{{ url("/dashboard/user/hubin") }}">Hubin</a></li>
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                href="{{ url("/dashboard/user/pembimbing") }}">Pembimbing</a></li>
                        <li><a class="text-secondary link-dark link-underline link-underline-opacity-0" href="{{ url("/dashboard/user/tu") }}">Tata
                                Usaha</a></li>
                    </ul>
                </div>

                <a href="{{ url("/dashboard/perusahaan") }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="bold" stroke-width="1.5" icon="building-1"></i></h3>
                    <h5 class="m-0">Perusahaan</h5>
                </a>

                <a href="{{ url("/dashboard/prakerin") }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="bold" stroke-width="1.5" icon="book-open"></i></h3>
                    <h5 class="m-0">Prakerin</h5>
                </a>

                <a href="{{ url("/dashboard/pengajuan") }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="bold" stroke-width="1.5" icon="clipboard-text"></i></h3>
                    <h5 class="m-0">Pengajuan</h5>
                </a>

                <a href="{{ url("/dashboard/monitoring") }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="bold" stroke-width="1.5" icon="monitor"></i></h3>
                    <h5 class="m-0">Monitoring</h5>
                </a>
            </div>
        </aside>

        <main class="overflow-y-auto" style="height: 100vh">
            <nav class="navbar px-0 navbar-expand-lg navbar-light border-bottom">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto align-items-center">
                            <!-- Authentication Links -->
                            @auth
                                <li class="nav-item  mx-4 d-flex align-items-center">
                                    <p class="m-0 fs-lg">Hello,
                                        {{ Auth::user()->username }}
                                    </p>
                                    <h1 class="m-auto mx-2"><i class="bi bi-person-circle"></i></h1>
                                    <div>
                                        <p class="text-capitalize m-0 text-secondary"></p>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="btn logout btn-danger rounded-4" href="{{ route("logout") }}">
                                        <i class="iconsax" type="linear" stroke-width="1.5" icon="logout-1"></i>
                                        {{ __("Logout") }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </main>
    </div>

    @yield("footer")
    <script type="module">
        $("#dropdownToggle").click(function() {
            if ($("#dropdownList").first().is(":hidden")) {
                $("#dropdownList").slideDown("slow");
                $(this).css('rotate', '-90deg')
            } else {
                $("#dropdownList").slideUp();
                $(this).css('rotate', '90deg')
            }
        })
    </script>
</body>

</html>