@extends("layouts.index")
@section("title", "$user_detail->nama")

@section("content")
    <h1>{{ $user_detail->nama }}</h1>
    <div class="row">
        <div class="col-6 vh-100">
            <div class="card w-100 bg-white">
                @isset($user->foto_profil)
                    <div class="d-flex justify-content-center">
                        <img src="{{ route("displayImage", ["uri" => $user->foto_profil]) }}" class="mt-2 rounded-3 w-50"
                            style="aspect-ratio:1/1;object-fit:cover" alt="{{ $user_detail->nama }}">
                    </div>
                @endisset
                <div class="mt-4 px-3">
                    <label class="w-100" for="">
                        <form id="uploadFoto" enctype="multipart/form-data">
                            <span>Upload foto profil</span>
                            <div class="row">
                                <div class="col pe-0">
                                    <input accept=".jpg, .jpeg, .png, .svg" name="foto_profil" class="form-control rounded-start-4 rounded-end-0"
                                        type="file" id="formFile">
                                </div>
                                <div class="col-auto ps-0">
                                    <button class="btn btn-outline-secondary rounded-end-4 rounded-start-0 px-4">Upload</button>
                                </div>
                            </div>
                        </form>
                    </label>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <div class="row pt-1 border-top mt-2">
                            <div class="col">Username</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $user->username }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Role</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $user->role }}</div>
                        </div>
                        @foreach ($user_detail_key as $key)
                            <div class="row">
                                <div class="col">{{ $key }}</div>
                                <div class="col-1">:</div>
                                <div class="col">{{ $user_detail[$key] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mx-1 mt-3">
                        <div class="col p-0">
                            <a href="{{ url("dashboard?role=$user->role", ["user", "edit", $user->id]) }}"
                                class="col w-100 rounded-start-pill btn btn-primary">Edit</a>
                        </div>
                        <div class="col-auto p-0">
                            <a href="#" class="deleteButton d-flex align-items-center gap-2 w-100 rounded-end-pill btn btn-danger">
                                <i class="iconsax text-light" type="linear" icon="trash" style="zoom: 0.8"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 vh-100"></div>
    </div>
@endsection
@section("footer")
    <script type="module">
        function alertResponse(data) {
            let message = '';
            console.error(data)
            Object.values(data).flat().map((e) =>
                message += `<strong class="text-danger d-block">${e}</strong>`
            );

            swal.fire({
                titleText: "Gagal",
                icon: "error",
                html: message,
            })
        }

        function alertSuccess(type, toShow = '', redirectLocation = null) {
            swal.fire({
                titleText: `Data berhasil di${type}`,
                icon: "success",
                text: `${toShow} Berhasil di${type}`,
            }).finally(() => redirectLocation ? window.location = redirectLocation : window.location.reload())
        }

        $("#uploadFoto").on("submit", function(e) {
            e.preventDefault()
            let toSend = new FormData(e.target)
            // console.log(Object.fromEntries(toSend));
            axios.post("/api/user/<?php echo $user->id; ?>/upload", toSend, {
                    "Content-Type": "multipart/form-data"
                })
                .then(({
                        data
                    }) =>
                    alertSuccess('upload', data?.foto_profil))
                .catch(({
                    response
                }) => alertResponse(response?.data?.errors))
        })
        $(".deleteButton").click(function(e) {
            swal.fire({
                titleText: `Apakah anda yakin untukmenghapus <?= $user_detail->nama ?>`,
                backdrop: false,
                icon: "question",
                showDenyButton: true,
                confirmButtonText: "Ya, Hapus",
                denyButtonText: "Tidak",
            }).then(({
                    isConfirmed
                }) => isConfirmed &&
                axios.delete(`/api/user/<?= $user->id ?>`)
                .then(() => alertSuccess('hapus', "<?= $user_detail->nama ?>", "/dashboard/user"))
                .catch(({
                    response
                }) => alertResponse(response?.data))
            )
        })
    </script>
@endsection
