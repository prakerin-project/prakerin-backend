@extends('layouts.index')
@section('title', 'Pengajuan')
@section('content')

    <div class="row mb-3">
        <div class="col  d-flex justify-content-between align-items-center">
            <h1>Pengajuan Saya</h1>
            <a href="{{ url('/dashboard/pengajuan/tambah') }}" class="btn btn-primary"><i class="iconsax" type="linear"
                    stroke-width="1.5" icon="clipboard-text"></i>Tambah Pengajuan</a>
        </div>
    </div>
    <div class="row">
        @for ($i = 0; $i < 5; $i++)
            <div class="col-md-6 col-lg-4">
                <div class="card mb-3" style="break-inside: avoid-column">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center gap-2">
                        <h2 class="m-0">PT. Bangun Tidur Lagi</h2>
                        <span class="badge text-bg-warning p-2">Belum disetujui</span>
                    </div>
                    <div class="card-body bg-white">
                        <h5>Persetujuan : </h5>
                        <div class="border p-2 rounded">
                            <div class="form-check ps-2 d-flex gap-2 justify-content-between align-items-center">
                                <label class="m-0 form-check-label">1. Sri Wahyuni (Wali kelas)</label>
                                <input type="checkbox" class="form-check-input" name="" id="" checked
                                    style="zoom: 1.2">
                            </div>
                            <div class="form-check ps-2 d-flex gap-2 justify-content-between align-items-center">
                                <label class="m-0 form-check-label">2. Sri Wahyuni (Wali kelas)</label>
                                <input type="checkbox" class="form-check-input" name="" id="" checked
                                    style="zoom: 1.2">
                            </div>
                            <div class="form-check ps-2 d-flex gap-2 justify-content-between align-items-center">
                                <label class="m-0 form-check-label">3. Sri Wahyuni (Wali kelas)</label>
                                <input type="checkbox" class="form-check-input" name="" id="" checked
                                    style="zoom: 1.2">
                            </div>
                        </div>
                    </div>
                    <div class="row card-footer mx-0 d-flex gap-1">
                        <a href="{{ url('/dashboard/pengajuan/detail') }}" class="col-8 btn btn-primary">Detail</a>
                        <a href="" class="col btn btn-danger"><i class="iconsax" type="linear" stroke-width="1.5"
                                icon="trash"></i></a>
                    </div>
                </div>
            </div>
        @endfor
    </div>

@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        })
    </script>
@endsection
