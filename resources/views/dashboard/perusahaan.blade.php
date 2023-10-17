@extends('layouts.index')
@section('title', 'Perusahaan')
@section('content')
    <div class="row">
        <div class="col d-flex justify-content-between mb-3">
            <div>
                <h1>Perusahaan</h1>
            </div>
            <button type="button" class="btn flex-grow btn-primary" data-bs-toggle="modal"
                    data-bs-target="#tambah-ps-modal"><i
                    class="bi bi-building-add"></i> Tambah
            </button>

            <!-- Tambah Perusahaan Modal -->
            <div class="modal fade" id="tambah-ps-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Perusahaan</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-ps-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama-perusahaan">Nama Perusahaan</label>
                                    <input type="text" id="nama-perusahaan" class="form-control mb-3"
                                           autofocus
                                           name="nama_perusahaan"
                                           required/>
                                    <label for="j-perusahaan">Jenis Perusahaan</label>
                                    <select name="id_jenis_perusahaan" id="j-perusahaan" class="form-select mb-3"
                                            required>
                                        <option selected value="">Pilih jenis perusahaan</option>
                                        @foreach($jenis_perusahaan as $jp)
                                            <option value="{{$jp->id}}">{{$jp->nama}}</option>
                                        @endforeach
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
                                                   class="btn flex p-2 btn-outline-success form-control"><i
                                                    class="bi-camera-fill"></i> Upload
                                                Foto </label>
                                            <input type="file" accept="image/*" multiple name="foto[]" id="fileUpload"
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
                <th class="text-center">No</th>
                <th>Nama Perusahaan</th>
                <th>Jenis Perusahaan</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            ?>
            @foreach($perusahaan as $p)
                <tr idPerusahaan='{{ $p->id }}'>
                    <td class="text-center">{{$no++}}</td>
                    <td>{{$p->nama_perusahaan}}</td>
                    <td>{{$p->jenis_perusahaan->nama}}</td>
                    <td>{{$p->email}}</td>
                    <td>{{$p->alamat}}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if(isset($p->foto) && count($p->foto) > 0)
                               <img src="{{url('storage/perusahaan/'.$p->foto[0]->path)}}" width="100px" alt="">
                            @else
                                No data available
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- Button trigger edit modal -->
                            <a href="" class="link-underline flex-shrink-1 link-underline-opacity-0">
                                <h4><i class="bi bi-eye"></i></h4>
                            </a>
                            <a href="" class="text-warning link-underline link-underline-opacity-0">
                                <h4><i class="bi bi-pen"></i></h4>
                            </a>
                            <a href="#" class="text-danger hapusBtn cursor-pointer link-underline link-underline-opacity-0">
                                <h4><i class="bi bi-trash3-fill"></i></h4>

                        </div>
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
        $('.table').DataTable();

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
        $('#tambah-ps-form').on('submit', function (e) {
            e.preventDefault(this);
            let data = new FormData(e.target);
            let file = $('#fileUpload')[0].files;
            data.append('foto', file);

            console.log(Object.fromEntries(data));
            axios.post('/api/perusahaan', data, {
                'Content-Type': 'multipart/form-data'
            })
                .then((res) => {
                    // console.log(res);
                    $('#tambah-perusahaan-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch(({response}) => {
                    let message = '';
                    console.log(response)
                
                    Object.values(response.data).flat().map((e) =>
                        message += `<strong class="text-danger d-block">${e}</strong>`
                    );
                
                    swal.fire('Gagal tambah data!', `${message}`, 'warning');
                });
        })

        /*-------------------------- HAPUS PERUSAHAAN -------------------------- */
        $('.table').on('click', '.hapusBtn', function (e) {
            e.preventDefault(this)
            let idPerusahaan = $(this).closest('tr').attr('idPerusahaan');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`http://localhost:8000/api/perusahaan/${idPerusahaan}`)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.status == 'success') {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function () {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            } else {
                                swal.fire('Gagal di hapus!', '', 'warning');
                            }
                        }).catch(function () {
                        swal.fire('Data gagal di hapus!', '', 'error').then(function () {
                            //Refresh Halaman
                            location.reload();
                        });
                    });
                }
            });
        })
    </script>
@endsection
