@extends('layouts.index')
@section('title', 'Jenis Perusahaan')
@section('content')
    <div class="row">
        <div class="col d-flex align-items-center justify-content-between mb-3">
            <div>
                <h1>Jenis Perusahaan</h1>
            </div>
            @if(auth()->user()->role == 'hubin')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-jp-modal"><i
                    class="iconsax" type="linear" stroke-width="1.5" icon="buildings-1"></i> Tambah
            </button>
            @endif

            <!-- Tambah Jenis Perusahaan Modal -->
            <div class="modal fade" id="tambah-jp-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Perusahaan</h1>
                        </div>
                        <div class="modal-body">
                            <form id="tambah-jp-form">
                                <div class="form-group">
                                    <label for="nama">Nama jenis perusahaan</label>
                                    <input type="text" id="nama" class="form-control mb-3" autofocus name="nama"
                                        required />
                                    @csrf
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary" form="tambah-jp-form">Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
                <tr>
                    <th class="col-1 text-center">No</th>
                    <th>Jenis Perusahaan</th>
                    <th>Jumlah Perusahaan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                ?>
                @foreach ($jenis_perusahaan as $jp)
                    <tr idJp='{{ $jp->id }}'>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $jp->nama }}</td>
                        <td>{{ $jp->perusahaan->count() }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ url("/dashboard/perusahaan/jenis/$jp->id") }}" class="link-underline flex-shrink-1 link-underline-opacity-0">
                                <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="eye"></i></h4>
                            </a>
                            @if(auth()->user()->role == 'hubin')
                            <a href="" class="editBtn text-warning link-underline link-underline-opacity-0"
                                data-bs-toggle="modal" data-bs-target="#edit-modal-{{ $jp->id }}"
                                idJp="{{ $jp->id }}">
                                <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="edit-1"></i></h4>
                            </a>
                            <a href="#"
                                class="text-danger hapusBtn cursor-pointer link-underline link-underline-opacity-0">
                                <h4><i class="iconsax" type="linear" stroke-width="1.5" icon="trash"></i></h4>
                            </a>
                            @endif
                        </td>
                    </tr>

                    <!-- Edit Jenis Perusahaan Modal -->
                    <div class="modal fade" id="edit-modal-{{ $jp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Perusahaan</h1>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-jp-form-{{ $jp->id }}">
                                        <div class="form-group">
                                            <label for="nama">Nama jenis perusahaan</label>
                                            <input type="text" id="nama" class="form-control mb-3" autofocus
                                                name="nama" value="{{ $jp->nama }}"/>
                                            @csrf
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary" form="edit-jp-form-{{ $jp->id }}">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        });

        /*-------------------------- TAMBAH JENIS PERUSAHAAN -------------------------- */
        $('#tambah-jp-form').on('submit', function(e) {
            e.preventDefault(this);
            let data = new FormData(e.target);

            console.log(Object.fromEntries(data));
            axios.post('/api/perusahaan/jenis', data)
                .then((res) => {
                    // console.log(res);
                    $('#tambah-jp-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function() {
                        location.reload();
                    })
                })
                .catch(({
                    response
                }) => {
                    let message = '';
                    console.log(response)

                    Object.values(response.data).flat().map((e) =>
                        message += `<strong class="text-danger d-block">${e}</strong>`
                    );

                    swal.fire('Gagal tambah data!', `${message}`, 'warning');
                });
        })

        /*-------------------------- EDIT JENIS PERUSAHAAN -------------------------- */
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idJp = $(this).attr('idJp');
            $(`#edit-jp-form-${idJp}`).on('submit', function (e) {
                e.preventDefault(this);
                let data = new FormData(e.target);
                const value = Object.fromEntries(data.entries());
                axios.put(`http://localhost:8000/api/perusahaan/jenis/${idJp}`, value)
                    .then(() => {
                        $(`#edit-modal-${idJp}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(({response}) => {
                        console.log(response)
                        let message = '';

                        Object.values(response.data).flat().map((e) =>
                            message += `<strong class="text-danger d-block">${e}</strong>`
                        );

                        swal.fire('Gagal tambah data!', `${message}`, 'warning');
                    })
            })
        })

        /*-------------------------- HAPUS JENIS PERUSAHAAN -------------------------- */
        $('.table').on('click', '.hapusBtn', function(e) {
            e.preventDefault(this)
            let idJp = $(this).closest('tr').attr('idJp');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    //dilakukan proses hapus
                    axios.delete(`http://localhost:8000/api/perusahaan/jenis/${idJp}`)
                        .then(function(response) {
                            console.log(response);
                            if (response.data.status == 'success') {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            } else {
                                swal.fire('Gagal di hapus!', '', 'warning');
                            }
                        }).catch(function() {
                            swal.fire('Data gagal di hapus!', '', 'error').then(function() {
                                //Refresh Halaman
                                location.reload();
                            });
                        });
                }
            });
        })
    </script>
@endsection
