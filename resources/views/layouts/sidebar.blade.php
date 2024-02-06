<div class="btn rounded btn-primary position-absolute" @style(['right: 10px', 'bottom: 10px']) id="sidebar-toggle">
    <i class="iconsax" type="linear" stroke-width="1.5" icon="menu-1"></i>
</div>
<aside class="position-relative position-fixed z-3 h-100 bg-white flex-column align-items-center p-0 border"
    id="sidebar" style="width: 300px;display: flex;max-height: 100vh; overflow-y: auto;">
    <img src="{{ asset('one-logo.svg') }}" alt="logo" width="80px">

    <div class="menu rounded w-100 px-4 position-relative">
        <a href="{{ url('/dashboard') }}"
            class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
            <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="home-2"></i></h3>
            <h5 class="m-0">Dashboard</h5>
        </a>

        <p class="mb-0 mt-3">Menu</p>

        <div class="d-flex h-100 flex-column justify-content-between">
            <div>
                @if (!in_array($user_role, ['pb_industri', 'siswa']))
                    <div class="dropdown">
                        <div
                            class="d-flex justify-content-between menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                            <a href="{{ url('/dashboard/user') }}"
                                class="text-dark d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                                <h3 class="m-0"><i class="iconsax" type="linear" icon="user"></i></h3>
                                <h5 class="m-0">User</h5>
                            </a>
                            <div id="dropdownToggle" class="h-100">
                                <span class="fs-4">></span>
                            </div>
                        </div>
                        <ul id="dropdownList" style="list-style: none">
                            @if (in_array($user_role, ['hubin', 'walas', 'tu']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/siswa') }}">Siswa</a></li>
                            @endif
                            @if (in_array($user_role, ['hubin', 'walas']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/walas') }}">Wali
                                        Kelas</a></li>
                            @endif
                            @if (in_array($user_role, ['hubin', 'kaprog']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/kaprog') }}">Kepala Program</a>
                                </li>
                            @endif
                            @if (in_array($user_role, ['hubin']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/hubin') }}">Hubin</a></li>
                            @endif
                            @if (in_array($user_role, ['hubin', 'kaprog', 'pb_sekolah']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/pembimbing') }}">Pembimbing</a></li>
                            @endif
                            @if (in_array($user_role, ['hubin', 'tu']))
                                <li><a class="text-secondary link-dark link-underline link-underline-opacity-0"
                                        href="{{ url('/dashboard/user/tu') }}">Tata Usaha</a></li>
                            @endif
                        </ul>
                    </div>
                @endif

                @if (in_array($user_role, ['hubin', 'siswa', 'pb_sekolah', 'kaprog']))
                    <a href="{{ url('/dashboard/perusahaan/jenis') }}"
                        class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="buildings-1"></i>
                        </h3>
                        <h5 class="m-0">Jenis Perusahaan</h5>
                    </a>

                    <a href="{{ url('/dashboard/perusahaan') }}"
                        class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="buildings-2"></i>
                        </h3>
                        <h5 class="m-0">Perusahaan</h5>
                    </a>
                @endif

                <a href="{{ url('/dashboard/jurusan') }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="signpost"></i></h3>
                    <h5 class="m-0">Jurusan</h5>
                </a>

                <a href="{{ url('/dashboard/kelas') }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="teacher"></i></h3>
                    <h5 class="m-0">Kelas</h5>
                </a>

                <a href="{{ url('/dashboard/prakerin') }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="book-open"></i>
                    </h3>
                    <h5 class="m-0">Prakerin</h5>
                </a>

                <a href="{{ url('/dashboard/pengajuan') }}"
                    class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="clipboard-text"></i>
                    </h3>
                    <h5 class="m-0">Pengajuan</h5>
                </a>

                @if (in_array($user_role, ['hubin', 'pb_sekolah', 'kaprog']))
                    <a href="{{ url('/dashboard/monitoring') }}"
                        class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="monitor"></i>
                        </h3>
                        <h5 class="m-0">Monitoring</h5>
                    </a>
                @endif
                @if ($user_role == 'hubin')
                    <a href="{{ url('/dashboard/log') }}"
                        class="menu-item text-dark py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5"
                                icon="menu-board"></i>
                        </h3>
                        <h5 class="m-0">Logs</h5>
                    </a>
                @endif
            </div>


            @auth
                <a href="{{ route('logout') }}"
                    class="text-danger logout py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="logout-1"></i>
                    </h3>
                    <h5 class="m-0">Logout</h5>
                </a>
            @endauth
        </div>
    </div>
</aside>
<script type="module" defer>
    $('#sidebar-toggle').click(function() {
        $("#sidebar").animate({
            width: "toggle",
            display: "none"
        });
    });
</script>
