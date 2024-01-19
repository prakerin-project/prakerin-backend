@extends('layouts.index')
@section('title', 'User')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>User</h1>
        </div>
        <button type="button" class="btn rounded-4 btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-user-modal">
            <i class="iconsax" type="linear" stroke-width="1.5" icon="user-add" width="10px"></i>
            Tambah
        </button>

        <!-- Tambah User Modal -->
        <div class="modal fade" data-bs-backdrop="static" id="tambah-user-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah User</h1>
                    </div>
                    <div class="modal-body">
                        <form id="tambah-user-form" data-request-link="">
                            <div class="form-group">
                                @csrf
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" autofocus name="username" />
                                <label for="password">Password</label>
                                <input type="text" id="password" class="form-control" name="password" />
                                <label for="nama">Nama</label>
                                <input type="text" id="nama" class="form-control" autofocus name="nama" />
                                <label for="no_telp">No telp</label>
                                <input type="text" id="no_telp" class="form-control" name="no_telp" />
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">Pilih Jenis kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="kaprog">Kaprog</option>
                                    <option value="pembimbing">Pembimbing</option>
                                    <option value="walas">Walas</option>
                                    <option value="tu">Tata Usaha</option>
                                    <option value="siswa">Siswa</option>
                                    <option value="hubin">Hubin</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" disabled class="btn btn-primary" form="tambah-user-form">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered" id="DataTable">
        <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
            <tr>
                <th class="col-1 text-center">No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr user-id="{{ $user->id }}" user-name="{{ $user->username }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="d-flex gap-3">
                        <!-- Button trigger detail modal -->
                        <a href="{{ url("dashboard?role=$user->role", ['user', $user->id]) }}"
                            class="link-underline link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                        </a>
                        <!-- Button trigger edit modal -->
                        <a href="{{ url("dashboard?role=$user->role", ['user', 'edit', $user->id]) }}"
                            class="text-warning link-underline link-underline-opacity-0 editButton">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i></h4>
                        </a>
                        <!-- Button trigger delete modal -->
                        <a href="#delete" class="text-danger link-underline link-underline-opacity-0 deleteButton">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="trash"></i></h4>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
@section('footer')
    <script type="module">
        function alertResponse(data) {
            let message = '';
            Object.values(data).flat().map((e) =>
                message += `<strong class="text-danger d-block">${e}</strong>`
            );

            swal.fire({
                titleText: "Gagal",
                icon: "error",
                html: message,
            })
        }

        function alertSuccess(type, toShow = '') {
            swal.fire({
                titleText: `Data berhasil di${type}`,
                icon: "success",
                text: `${toShow} Berhasil di${type}`,
            }).finally(() => window.location.reload())
        }

        const dataJurusan = axios.get('/api/jurusan')
            .then(({
                data
            }) => data)
            .catch(() => swal.fire("Something went wrong", "Please reload page", "error").finally(() => window.location
                .reload()))

        const dataKelas = axios.get('/api/kelas', {
                params: {
                    relation: ['jurusan']
                }
            })
            .then(({
                data
            }) => data)
            .catch(() => swal.fire("Something went wrong", "Please reload page", "error").finally(() => window.location
                .reload()));

        $("#DataTable").DataTable({
            searching: false,
            info: false,
            paging: false,
        })

        $(".deleteButton").click(function(e) {
            e.preventDefault()
            let userId = $(this).closest("tr").attr("user-id")
            swal.fire({
                titleText: `Apakah anda yakin untukmenghapus ${$(this).closest("tr").attr("user-name")}`,
                backdrop: false,
                icon: "question",
                showDenyButton: true,
                confirmButtonText: "Ya, Hapus",
                denyButtonText: "Tidak",
            }).then(({
                    isConfirmed
                }) => isConfirmed &&
                axios.delete(`/api/user/${userId}`)
                .then(() => alertSuccess('hapus'))
                .catch(({
                    response
                }) => alertResponse(response?.data)))
        })
        $("#role").on("change", async function() {
            renderForm(this, await dataJurusan, await dataKelas)
        })
        $("#tambah-user-form").on("submit", function(e) {
            e.preventDefault()
            const toSend = new FormData(e.target)
            axios.post($(this).data('request-link'), toSend, {
                    'Content-Type': "multipart/form-data"
                })
                .then(({
                    data
                }) => alertSuccess('tambah', data?.user?.username))
                .catch(({
                    response
                }) => alertResponse(response?.data))
        })

        function renderForm(e, jurusan = [], kelas = [], val = {}) {
            $("button[form='tambah-user-form']").attr("disabled", false)
            if ($(e).val() === "")
                $("button[form='tambah-user-form']").attr("disabled", true)
            const optJurusan = jurusan.map((jurusan, i) => {
                return jurusan[i] = `<option value="${jurusan.id}">${jurusan.nama_jurusan}</option>`
            }).join('\n');
            const optKelas = kelas.map((kelas, i) => {
                return kelas[i] =
                    `<option value="${kelas.id}">${kelas.angkatan} - ${kelas.tingkat} ${kelas.jurusan.akronim} ${kelas.kelompok ? kelas.kelompok : ''}</option>`
            }).join('\n');

            $("#tambah-user-form>*").not(".form-group").remove()

            $("#tambah-user-form").attr("data-request-link", `/api/user/${$(e).val()}`)
            switch ($(e).val()) {
                case "kaprog":
                    $("#tambah-user-form")
                        .append("<label for='nip'>NIP Kaprog</label>")
                        .append("<input class='form-control' id='nip' name='nip'/>")
                        .append("<label for='id_jurusan'>Pilih jurusan</label>")
                        .append("<select class='form-select' id='id_jurusan' name='id_jurusan'>" +
                            "<option value=''>Pilih jurusan</option>" +
                            optJurusan + "</select>")
                    break;
                case "pembimbing":
                    $("#tambah-user-form")
                        .append("<label for='lingkup'>Lingkup</label>")
                        .append(
                            "<select class='form-select' id='lingkup' name='lingkup'><option value=''>Pilih lingkup</option><option value='sekolah'>Sekolah</option><option value='industri'>Industri</option></select>"
                        )
                        .append("<label for='nip_nik'>NIP/NIK Pembimbing</label>")
                        .append("<input class='form-control' id='nip_nik' name='nip_nik'/>")
                        .append("<label for='email'>Email Pembimbing</label>")
                        .append("<input type='email' class='form-control' id='email' name='email'/>")
                        .append("<label for='id_jurusan'>Pilih jurusan</label>")
                        .append("<select class='form-select' id='id_jurusan' name='id_jurusan'>" +
                            "<option value=''>Pilih jurusan</option>" +
                            optJurusan + "</select>")
                    break;
                case "walas":
                    $("#tambah-user-form")
                        .append("<label for='nip'>NIP Walas</label>")
                        .append("<input class='form-control' id='nip' name='nip'/>")
                        .append("<label for='id_kelas'>Pilih kelas</label>")
                        .append("<select class='form-select' id='id_kelas' name='id_kelas'>" +
                            "<option value=''>Pilih kelas</option>" +
                            optKelas + "</select>")
                    break;
                case 'tu':
                    $("#tambah-user-form")
                        .append("<label for='nip'>NIP Tata Usaha</label>")
                        .append("<input class='form-control' id='nip' name='nip'/>")
                    break;
                case 'siswa':
                    // ! INPUT DATE IN TANGGAL LAHIR
                    $("#tambah-user-form")
                        .append("<label for='nis'>NIS Siswa</label>")
                        .append("<input class='form-control' id='nis' name='nis'/>")
                        .append("<label for='id_kelas'>Pilih kelas</label>")
                        .append("<select class='form-select' id='id_kelas' name='id_kelas'>" +
                            "<option value=''>Pilih kelas</option>" +
                            optKelas + "</select>")
                        .append("<label for='email'>Email Siswa</label>")
                        .append("<input type='email' class='form-control' id='email' name='email'/>")
                        .append("<label for='no_telp_wali'>No.telp wali</label>")
                        .append("<input class='form-control' id='no_telp_wali' name='no_telp_wali'/>")
                        .append("<label for='tahun_masuk'>Tahun masuk</label>")
                        .append("<input class='form-control' id='tahun_masuk' name='tahun_masuk'/>")
                        .append("<label for='tanggal_lahir'>Tanggal Lahir</label>")
                        .append("<input type='date' class='form-control' id='tanggal_lahir' name='tanggal_lahir'/>")
                        .append("<label for='tempat_lahir'>Tempat Lahir</label>")
                        .append("<input class='form-control' id='tempat_lahir' name='tempat_lahir'/>")
                        .append("<div class='form-floating mt-3'>" +
                            "<textarea class='form-control' id='alamat' placeholder='Alamat' name='alamat' style='height: 200px; resize:none'></textarea>" +
                            "<label for='alamat'>Alamat</label>" +
                            "</div>")
                    break;
                case 'hubin':
                    $("#tambah-user-form")
                        .append("<label for='nip'>NIP Hubin</label>")
                        .append("<input class='form-control' id='nip' name='nip'/>")
                    break;
            }
        }
    </script>
@endsection
