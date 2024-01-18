@extends('layouts.index')
@section('title', 'Daftar Kelas')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Kelas</h1>
        @if (auth()->user()->role == 'hubin')
            <button type="button" class="btn btn-primary rounded-4" data-bs-toggle="modal"
                data-bs-target="#tambah-kelas-modal"><i class="iconsax" type="linear" stroke-width="1.5" icon="teacher"></i>
                Tambah
            </button>
        @endif
    </div>
    {{-- START MODAL TAMBAH --}}
    <div class="modal fade" id="tambah-kelas-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
                </div>
                <div class="modal-body">
                    <form id="tambah-kelas-form" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="jurusan-select">Jurusan</label>
                            <select name="id_jurusan" id="jurusan-select" class="form-select" required>
                                <option value="" selected hidden>Pilih jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tingkat-select">Tingkat</label>
                            <select name="tingkat" id="kelompok-select" class="form-select" required>
                                <option value="" selected hidden>Pilih tingkat kelas</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelompok-select">Kelompok</label>
                            <select name="kelompok" id="kelompok-select" class="form-select">
                                <option value="" selected hidden>Pilih kelompok</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            <div class="text-secondary" style="font-size: 0.8rem">Catatan: tidak perlu dipilih jika hanya
                                terdapat 1 kelas saja</div>
                        </div>
                        <div class="form-group">
                            <label for="angkatan-input">Angkatan</label>
                            <input type="text" name="angkatan" id="angkatan-input" class="form-control"
                                inputmode="numeric" pattern="[0-9]+" required autocomplete="off">
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" form="tambah-kelas-form">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL TAMBAH --}}
    <div class="d-grid gap-3 mt-3" style="grid-template-columns: repeat(4, 1fr);">
        @foreach ($kelas as $k)
            <div class="card p-0">
                <a href="{{ url('/dashboard/kelas/' . $k->id) }}" class="text-decoration-none text-black">
                    <div class="card-header bg-primary text-bg-primary d-flex justify-content-between">
                        <h1>{{ $k->tingkat }} {{ $k->jurusan->akronim }} {{ $k->kelompok }}</h1>
                    </div>
                    <div class="card-body bg-white rounded text-black">
                        <table>
                            <tr>
                                <td>Angkatan</td>
                                <td class="px-1">:</td>
                                <td class="px-1">{{ $k->angkatan }}</td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td class="px-1">:</td>
                                <td class="px-1">{{ $k->jurusan->nama_jurusan }}</td>
                            </tr>
                        </table>
                    </div>
                </a>

                @if (auth()->user()->role == 'hubin')
                    <div class="p-1 card-footer d-flex">
                        <button type="button"
                            class="bg-transparent border-0 text-danger w-100 d-flex justify-content-center gap-1">
                            <div><i class="iconsax" type="bold" stroke-width="1.5" icon="trash"></i></div>
                        </button>
                    </div>
                @endif
            </div>
        @endforeach

        {{-- @foreach ($angkatan as $a)
            <div class="col-4">
                <div class="card p-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="fs-2">Angkatan {{ $a->angkatan }}</h1>
                        <table>
                            <tr>
                                <td class="fs-6">Jumlah kelas</td>
                                <td class="fs-6">:</td>
                                <td class="fs-6">{{ $a->jumlah_kelas }}</td>
                            </tr>
                            <tr>
                                <td class="fs-6">Jumlah siswa</td>
                                <td class="fs-6">:</td>
                                <td class="fs-6">{{ $a->jumlah_siswa }}</td>
                            </tr>
                            <tr>
                                <td class="fs-6">Tahun masuk</td>
                                <td class="fs-6">:</td>
                                <td class="fs-6">{{ $a->tahun_masuk }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body bg-white rounded d-grid gap-2" style="grid-template-columns: repeat(5, 1fr)">
                        <a href="" class="bg-primary rounded-4 text-bg-primary text-decoration-none p-2">
                            12 MM A
                        </a>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection
@section('footer')
    <script type="module">
        $('#tambah-kelas-form').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(e.target);

            axios.post('/api/kelas', data)
                .then((res) => {
                    $('#tambah-kelas-modal').css('display', 'none')
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
    </script>
@endsection
