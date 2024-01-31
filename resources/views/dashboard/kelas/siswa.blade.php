@extends('layouts.index')
@section('title', 'Kelas saya')
@section('content')
    <h1>Kelas {{ $kelas->tingkat }} {{ $kelas->jurusan->akronim }} {{ $kelas->kelompok }}</h1>
    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-white d-flex flex-column text-center justify-content-center">
                    <h3>Wali Kelas</h3>
                    @if ($walas)
                        @if ($walas->user->foto_profil)
                            <img src="{{ route('displayImage', ['uri' => $walas->user->foto_profil, 'folder' => 'user']) }}"
                                width="300px" height="300px" alt="foto-profil" style="object-position: top"
                                class="align-self-center rounded-circle">
                        @endif
                        <h5 class="mt-3 mb-0">{{ $walas->nama }}</h5>
                    @endif
                </div>
                <div class="card-body bg-white rounded">
                    <table>
                        <tr>
                            <td>Angkatan</td>
                            <td class="px-2">:</td>
                            <td class="px-2 text-primary">{{ $kelas->angkatan }}</td>
                        </tr>
                        @if (count($kelas->siswa) > 0)
                            <tr>
                                <td>Tahun masuk</td>
                                <td class="px-2">:</td>
                                <td class="px-2 text-primary">{{ $kelas->siswa[0]->tahun_masuk }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Jurusan</td>
                            <td class="px-2">:</td>
                            <td class="px-2">{{ $kelas->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah siswa</td>
                            <td class="px-2">:</td>
                            <td class="px-2 text-primary">{{ $kelas->siswa->count() }}</td>
                        </tr>
                    </table>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
