@extends('layouts.index')
@section('title', $kelas->tingkat . ' ' . $kelas->jurusan->akronim . ' ' . $kelas->kelompok . ' | ' . $kelas->angkatan)
@section('content')
    <h1>Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan->akronim }} {{ $kelas->kelompok }}</h1>
    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                @if ($walas)
                    <div class="card-header bg-white d-flex flex-column text-center justify-content-center">
                        @if ($walas->user->foto_profil)
                            <img src="{{ route('displayImage', ['uri' => $walas->user->foto_profil, 'folder' => 'user']) }}"
                                width="300px" height="300px" alt="foto-profil" style="object-position: top"
                                class="align-self-center rounded-circle">
                        @endif
                        <h5 class="mt-3 mb-0">{{ $walas->nama }}</h5>
                    </div>
                @endif
                <div class="card-body bg-white rounded">
                    <table>
                        <tr>
                            <td>Wali kelas</td>
                            <td class="px-2">:</td>
                            <td class="px-2">{{ $walas ? $walas->nama : '-' }}</td>
                        </tr>
                        <tr>
                            <td>Angkatan</td>
                            <td class="px-2">:</td>
                            <td class="px-2">{{ $kelas->angkatan }}</td>
                        </tr>
                        @if (count($kelas->siswa) > 0)
                            <tr>
                                <td>Tahun masuk</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{ $kelas->siswa[0]->tahun_masuk }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Jurusan</td>
                            <td class="px-2">:</td>
                            <td class="px-2"><a
                                    href="/dashboard/jurusan/{{ $kelas->jurusan->id }}">{{ $kelas->jurusan->nama_jurusan }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah siswa</td>
                            <td class="px-2">:</td>
                            <td class="px-2 text-primary">{{ $kelas->siswa->count() }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer bg-white">
                    <button type="button" class="btn btn-success d-flex rounded-3 gap-1 justify-content-center w-100"
                        data-bs-toggle="modal" data-bs-target="#edit-kelas-modal">
                        <i class="iconsax" style="zoom: 80%" type="linear" stroke-width="1.5" icon="edit-1"></i>
                        <div>Edit kelas</div>
                    </button>
                </div>
            </div>
        </div>
        <div class="col">
            <h3 class="text-center">Daftar siswa</h3>
            <table class="table rounded-2 overflow-hidden table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <td>No</td>
                        <td>NIS</td>
                        <td>Nama</td>
                        <td>Jenis kelamin</td>
                        <td>Email</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($kelas->siswa) < 1)
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada siswa</td>
                        </tr>
                    @endif
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kelas->siswa as $s)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>
                            <td>{{ $s->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- START EDIT MODAL --}}
    <div class="modal fade" id="edit-kelas-modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="edit-modal-title">Edit kelas</h1>
                </div>
                <div class="modal-body">
                    <form id="edit-kelas-form" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="jurusan-select">Jurusan</label>
                            <select name="id_jurusan" id="jurusan-select" class="form-select" required>
                                <option value="" selected hidden>Pilih jurusan</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}" @if ($j->id == $kelas->id_jurusan) selected @endif>
                                        {{ $j->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tingkat-select">Tingkat</label>
                            <select name="tingkat" id="kelompok-select" class="form-select" required>
                                <option value="" hidden>Pilih tingkat kelas</option>
                                <option value="10" @if ($kelas->tingkat == 10) selected @endif>10</option>
                                <option value="11" @if ($kelas->tingkat == 11) selected @endif>11</option>
                                <option value="12" @if ($kelas->tingkat == 12) selected @endif>12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelompok-select">Kelompok</label>
                            <select name="kelompok" id="kelompok-select" class="form-select">
                                <option value="">Pilih kelompok</option>
                                <option value="A" @if ($kelas->kelompok == 'A') selected @endif>A</option>
                                <option value="B" @if ($kelas->kelompok == 'B') selected @endif>B</option>
                                <option value="C" @if ($kelas->kelompok == 'C') selected @endif>C</option>
                            </select>
                            <div class="text-secondary" style="font-size: 0.8rem">Catatan: tidak perlu dipilih jika hanya
                                terdapat 1 kelas saja</div>
                        </div>
                        <div class="form-group">
                            <label for="angkatan-input">Angkatan</label>
                            <input type="text" name="angkatan" id="angkatan-input" class="form-control"
                                inputmode="numeric" pattern="[0-9]+" required autocomplete="off"
                                value="{{ $kelas->angkatan }}">
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" form="edit-kelas-form">Edit</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END EDIT MODAL --}}

@endsection
@section('footer')
    <script type="module">
        $('#edit-kelas-form').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(e.target);

            axios.put('/api/kelas/{{ $kelas->id }}', Object.fromEntries(data))
                .then((res) => {
                    $('#edit-kelas-modal').css('display', 'none')
                    swal.fire('Berhasil edit data!', '', 'success').then(function() {
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
