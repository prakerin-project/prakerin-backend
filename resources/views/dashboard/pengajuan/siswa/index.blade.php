@extends('layouts.index')
@section('title', 'Pengajuan')
@section('content')

    <div class="row">
        <div class="col d-flex justify-content-between align-items-center">
            <h1>Pengajuan saya</h1>

            <button class="btn bg-primary text-bg-primary rounded">
                <i class="iconsax" type="linear" stroke-width="1.5" icon="book-open"></i>
                Tambah
            </button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-4">
            <div class="card bg-white p-2">
                <h1 class="fs-2">Perusahaan ini</h1>
            </div>
        </div>
    </div>

@endSection

@section('footer')
@endsection
