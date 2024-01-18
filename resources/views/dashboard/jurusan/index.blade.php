@extends("layouts.index")
@section("title", "Jurusan")

@section("content")
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>Jurusan</h1>
        </div>
        <button type="button" class="btn rounded-4 btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-jurusan-modal">
            <i class="iconsax" type="linear" stroke-width="1.5" icon="user-add" width="10px"></i>
            Tambah
        </button>

        <!-- Tambah Jurusan Modal -->
        <div class="modal fade" id="tambah-jurusan-modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tambah Jurusan</h1>
                    </div>
                    <div class="modal-body">
                        <form id="tambah-jurusan-form">
                            <div class="form-group">
                                @csrf
                                <label for="nama_jurusan">Nama Jurusan</label>
                                <input type="text" id="nama_jurusan" class="form-control" autofocus name="nama_jurusan" />
                                <label for="akronim">Akronim</label>
                                <input type="text" id="akronim" class="form-control" name="akronim" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary" form="tambah-jurusan-form">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Edit Jurusan Modal --}}
        <div class="modal fade" id="edit-jurusan-modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit-modal-title"></h1>
                    </div>
                    <div class="modal-body">
                        <form id="edit-jurusan-form">
                            <div class="form-group">
                                @csrf
                                <label for="nama_jurusan">Nama Jurusan</label>
                                <input type="text" id="nama_jurusan" class="form-control" autofocus name="nama_jurusan" />
                                <label for="akronim">Akronim</label>
                                <input type="text" id="akronim" class="form-control" name="akronim" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-success" form="edit-jurusan-form">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered" id="DataTable">
        <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
            <tr>
                <th class="col-1 text-center">No</th>
                <th>Nama Jurusan</th>
                <th>Akronim</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_jurusan as $jurusan)
                <tr data-jurusan-id="{{ $jurusan->id }}" data-jurusan-nama="{{ $jurusan->nama_jurusan }}" data-jurusan-akronim="{{ $jurusan->akronim }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $jurusan->nama_jurusan }}</td>
                    <td class="text-center">{{ $jurusan->akronim }}</td>
                    <td class="d-flex gap-3">
                        <!-- Button trigger detail modal -->
                        <a href="{{ url("dashboard", ["jurusan","$jurusan->id"]) }}" class="link-underline link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                        </a>
                        <!-- Button trigger edit modal -->
                        <a href="#edit-{{ $jurusan->id }}" data-bs-toggle="modal" data-button="edit" data-bs-target="#edit-jurusan-modal"
                            class="text-warning link-underline link-underline-opacity-0 editButton">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i></h4>
                        </a>
                        <!-- Button trigger delete modal -->
                        <a href="#delete-{{ $jurusan->id }}" data-button="delete" class="text-danger link-underline link-underline-opacity-0">
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
        let id;

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
                text: `${toShow} berhasil di${type}`,
            }).finally(() => window.location.reload())
        }

        $("#DataTable").DataTable({
            info: false,
            searching: false,
            paging: false
        })
        $("#tambah-jurusan-form").on("submit", function(e) {
            e.preventDefault()
            const toSend = new FormData(e.target)
            const submitButton = $(this).parents().find('button')
            console.log(Object.fromEntries(toSend));

            submitButton.attr("disabled", true)
            axios.post('/api/jurusan', toSend, {
                    "Content-Type": "multipart/form-data"
                })
                .then(({
                    data
                }) => alertSuccess('tambah', data?.nama_jurusan))
                .catch(({
                    response
                }) => alertResponse(response?.data))
                .finally(() => submitButton.attr("disabled", false))
        })
        $("#edit-jurusan-form").on("submit", function(e) {
            e.preventDefault()
            const formData = new FormData(e.target)
            const submitButton = $(this).parents().find('button')
            const jsonToSend = Object.fromEntries(formData)

            submitButton.attr("disabled", true)
            axios.put(`/api/jurusan/${id}`, jsonToSend, {
                    "Content-Type": "application/json"
                })
                .then(({
                    data
                }) => alertSuccess('edit', data?.nama_jurusan))
                .catch(({
                    response
                }) => alertResponse(response?.data))
                .finally(() => submitButton.attr("disabled", false))
        })
        $("a[data-button=\"delete\"]").click(function(e) {
            const ref = $(this).closest("tr")
            id = ref.data("jurusan-id");
            const refDataVal = ref.data("jurusan-nama");
            swal.fire({
                titleText: `Apakah anda yakin untukmenghapus ${refDataVal}`,
                backdrop: false,
                icon: "question",
                showDenyButton: true,
                confirmButtonText: "Ya, Hapus",
                denyButtonText: "Tidak",
            }).then(({
                    isConfirmed
                }) => isConfirmed &&
                axios.delete(`/api/jurusan/${id}`)
                .then(({
                    data
                }) => alertSuccess('hapus'))
                .catch(({
                    response
                }) => alertResponse(response?.data))
            )
        })
        $("a[data-button=\"edit\"]").click(function(e) {
            const ref = $(this).closest("tr")
            id = ref.data("jurusan-id");
            const nama = ref.data("jurusan-nama");
            const akronim = ref.data("jurusan-akronim");
            const modalRef = $("#edit-jurusan-modal")

            modalRef.find("#edit-modal-title").text(`Edit Jurusan ${nama}`)
            modalRef.find("#nama_jurusan").val(`${nama}`)
            modalRef.find("#akronim").val(`${akronim}`)
        })
    </script>
@endsection
