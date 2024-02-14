<aside class="position-fixed h-100 bg-white flex-column align-items-center p-0 border" id="sidebar"
    @style(['z-index: 100','max-height: calc(100vh - 80px)', 'width: 300px', 'display: none', 'overflow-y: auto'])>

    <div class="h-100 w-100 p-3 position-relative">
        <h4>Menu</h4>
        <div class="menu d-flex flex-column gap-2 justify-content-between pb-5">
            <div class="d-flex gap-1 flex-column">
                <a href="{{ url('/dashboard') }}"
                    class="menu-item py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="home-2"></i></h3>
                    <h5 class="m-0">Dashboard</h5>
                </a>
                @if (!in_array($user_role, ['pb_industri', 'siswa']))
                    <div class="dropdown">
                        <div
                            class="d-flex justify-content-between py-2 px-2 menu-item rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                            <a href="{{ url('/dashboard/user') }}"
                                class="user-item d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
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
                        class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="buildings-1"></i>
                        </h3>
                        <h5 class="m-0">Jenis Perusahaan</h5>
                    </a>

                    <a href="{{ url('/dashboard/perusahaan') }}"
                        class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="buildings-2"></i>
                        </h3>
                        <h5 class="m-0">Perusahaan</h5>
                    </a>
                @endif

                <a href="{{ url('/dashboard/jurusan') }}"
                    class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="signpost"></i></h3>
                    <h5 class="m-0">Jurusan</h5>
                </a>

                <a href="{{ url('/dashboard/kelas') }}"
                    class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="teacher"></i></h3>
                    <h5 class="m-0">Kelas</h5>
                </a>

                <a href="{{ url('/dashboard/prakerin') }}"
                    class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="book-open"></i>
                    </h3>
                    <h5 class="m-0">Prakerin</h5>
                </a>

                <a href="{{ url('/dashboard/pengajuan') }}"
                    class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                    <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="clipboard-text"></i>
                    </h3>
                    <h5 class="m-0">Pengajuan</h5>
                </a>

                @if (in_array($user_role, ['hubin', 'pb_sekolah', 'kaprog']))
                    <a href="{{ url('/dashboard/monitoring') }}"
                        class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="monitor"></i>
                        </h3>
                        <h5 class="m-0">Monitoring</h5>
                    </a>
                @endif
                @if ($user_role == 'hubin')
                    <a href="{{ url('/dashboard/log') }}"
                        class="menu-item  py-2 px-2 rounded d-flex gap-3 align-items-center link-underline link-underline-opacity-0">
                        <h3 class="m-0"><i class="iconsax" type="linear" stroke-width="1.5" icon="menu-board"></i>
                        </h3>
                        <h5 class="m-0">Logs</h5>
                    </a>
                @endif
            </div>

        </div>
    </div>
</aside>
<script type="module" defer>
    $('#sidebar-toggle').click(function() {
        $("#sidebar").animate({
            width: "toggle",
            display: "flex"
        });

        $(this).toggleClass('btn-outline-primary btn-primary');
    });
    $(document).ready(function() {
        // Get the current URL
        var currentUrl = window.location.href;

        // Find all the menu items and iterate over them
        $('#sidebar .menu-item').each(function() {
            // Check if the href attribute matches the current URL
            if ($(this).attr('href') == currentUrl) {
                // Add the 'active' class to the parent menu item
                $(this).addClass('active');

                // If it's a dropdown item, also highlight the dropdown toggle
                $(this).closest('.dropdown').find('#dropdownToggle').addClass('active');
            }
        });
    });
</script>
