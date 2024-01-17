@extends('layouts.index')
@section('title', 'Pengajuan')
@section('content')

    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal pengajuan</th>
                        <th>Status</th>
                        <th>Siswa</th>
                        <th>Perusahaan</th>
                        <th>Alamat</th>
                        <th>Kontak perusahaan</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        })
    </script>
@endsection
