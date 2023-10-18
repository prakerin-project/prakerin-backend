@extends('layouts.index')
@section('title', 'User')
@section('content')
    <div class="row">
        <div class="col d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1>User</h1>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah-user-modal"><i
                    class="bi bi-person-fill-add"></i> Tambah
            </button>

            <!-- Tambah Perusahaan Modal -->
            <div class="modal fade" id="tambah-user-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-ps-form">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="form-control mb-3"
                                           autofocus
                                           name="username"
                                           required/>
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-select mb-3" required>
                                        <option selected value="">Pilih jenis perusahaan</option>

                                    </select>
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control mb-3"
                                           required autocomplete="off">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" style="height:
                                    100px"></textarea>
                                    <label class="d-block mt-3">Foto </label>
                                    <div class="row d-flex align-items-center">
                                        <div class="col-4">
                                            <label for="fileUpload"
                                                   class="btn flex p-1 btn-outline-success form-control"><i
                                                    class="bi-camera-fill"></i> Upload
                                                Foto </label>
                                            <input type="file" accept="image/*" multiple name="foto" id="fileUpload"
                                                   class="d-none form-control">
                                        </div>
                                        <div class="col p-0">
                                            <p class="fileName m-0 d-inline-block"></p>
                                        </div>
                                    </div>
                                    @csrf
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
        <table class="table table-bordered">
            <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
            <tr>
                <th class="col-1 text-center">No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">{{$no++}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->role}}</td>
                    <td class="d-flex gap-2">
                        <!-- Button trigger edit modal -->
                        <a href="" class="link-underline flex-shrink-1 link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                        </a>
                        <a href="" class="editBtn text-warning link-underline link-underline-opacity-0" data-bs-toggle="modal"
                        data-bs-target="#edit-modal-{{$user->id}}">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i></h4>
                        </a>
                        <a href="#" class="text-danger hapusBtn cursor-pointer link-underline link-underline-opacity-0">
                            <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="trash"></i></h4>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging:false
        });

        let fotos = [];
        $('input[type=file]').on('change', function (e) {
            for (let i = 0; i < this.files.length; i++) {
                fotos.push(this.files[i]);
            }

            console.log(fotos);
            // fotos.map((f) => {
            //     console.log(f.nama)
            // })
            // console.log(fotos)
        })

        /*-------------------------- TAMBAH SURAT -------------------------- */
        $('#tambah-user-form').on('submit', function (e) {
            e.preventDefault();
            let data = Object.fromEntries(new FormData(e.target));

            // console.log(Object.fromEntries(data));
            // axios.post('/perusahaan', data, {
            //     'Content-Type': 'multipart/form-data'
            // })
            //     .then(() => {
            //         $('#tambah-surat-modal').css('display', 'none')
            //         swal.fire('Berhasil tambah data!', '', 'success').then(function () {
            //             location.reload();
            //         })
            //     })
            //     .catch(({response}) => {
            //         let message = '';
            //
            //         Object.values(response.data.errors).flat().map((e) =>
            //             message += `<strong class="text-danger d-block">${e}</strong>`
            //         );
            //
            //         swal.fire('Gagal tambah data!', `${message}`, 'warning');
            //     });
        })
    </script>
@endsection
