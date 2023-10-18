@extends("layouts.index")
@section("title", "User")
@section("content")
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>User</h1>
        </div>
        <button type="button" class="btn rounded-4 btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-user-modal">
            <i class="iconsax" type="linear" stroke-width="1.5" icon="user-add" width="10px"></i>
            Tambah
        </button>

        <!-- Tambah User Modal -->
        <div class="modal fade" id="tambah-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    </div>
                    <div class="modal-body">
                        <form id="tambah-ps-form">
                            <div class="form-group">
                                @csrf
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" autofocus name="username" />
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="">Select Role</option>
                                    <option value="kaprog">Kaprog</option>
                                    <option value="pb_sekolah">Pembimbing Sekolah</option>
                                    <option value="pb_industri">Pembimbing Sekolah</option>
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
                        <button type="submit" class="btn btn-primary" form="tambah-ps-form">Tambah</button>
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
                <tr user-id={{ $user->id }}>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="d-flex gap-3">
                        <!-- Button trigger detail modal -->
                        <a href="{{ url("dashboard?role=$user->role", ["user", $user->id]) }}" class="link-underline link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                        </a>
                        <!-- Button trigger edit modal -->
                        <a href="#edit" class="text-warning link-underline link-underline-opacity-0 editButton">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i></h4>
                        </a>
                        <!-- Button trigger delete modal -->
                        <a href="" class="text-danger link-underline link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="trash"></i></h4>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
@section("footer")
    <script type="module">
        $("#DataTable").DataTable({
            searching: false,
            info: false,
            paging: false,
        })
        $(".editButton").click(function() {
            console.log($(this).closest("tr").attr("user-id"));
        })
        $("#role").on("change", function() {
            switch ($(this).val()) {
                case "kaprog":
                    $("#tambah-ps-form>*").not(".form-group").remove()
                    $("#tambah-ps-form")
                        .append("<label for='nip'>NIP Kaprog</label>")
                        .append("<Input class='form-control' id='nip' name='nip'/>")
                    break;
                case "pb_sekolah":
                    $("#tambah-ps-form>*").not(".form-group").remove()
                    $("#tambah-ps-form")
                        .append("<label for='nip'>NIP Pembimbing</label>")
                        .append("<Input class='form-control' id='nip' name='nip'/>")
                    break;
            }
        })
        $("#tambah-ps-form").on("submit", function(e) {
            e.preventDefault()
            const toSend = new FormData(e.target)
            console.log(Object.fromEntries(toSend));
        })
    </script>
@endsection
