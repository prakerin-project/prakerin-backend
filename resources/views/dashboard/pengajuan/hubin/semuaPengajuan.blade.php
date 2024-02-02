@extends('layouts.index')
@section('title', 'Pengajuan')
@section('content')
    <div class="row">
        <h1 class="mb-3">Semua pengajuan</h1>
        <div class="col">
            <table class="table table-bordered rounded overflow-hidden">
                <thead class="table-secondary">
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Perusahaan</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Tanggal pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->siswa->nis }}</td>
                            <td>{{ $pengajuan->siswa->nama }}</td>
                            <td>{{ $pengajuan->nama_industri }}</td>
                            <td>{{ $pengajuan->alamat_industri }}</td>
                            <td>{{ $pengajuan->status }}</td>
                            <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({

        })
    </script>
@endsection
