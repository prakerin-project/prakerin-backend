@extends('layouts.index')
@section('title', 'Daftar Kelas')
@section('content')
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary rounded-4" data-bs-toggle="modal" data-bs-target="#tambah-kelas-modal"><i
                class="iconsax" type="linear" stroke-width="1.5" icon="teacher"></i> Tambah
        </button>
    </div>
    <div class="row row-gap-4">
        @foreach ($data as $value)
            <div class="col-3">
                <a class="card" style="text-decoration: none;" href="" onmouseover="this.classList.add('shadow')"
                    onmouseout="this
      .classList.remove('shadow')">
                    <div class="card-header bg-primary text-light">
                        <h1 class="m-0">Angkatan {{ $value->angkatan }}</h1>
                    </div>
                    <div class="card-body bg-white rounded-2">
                        <div class="row">
                            <div class="col">Tahun masuk</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $value->tahun_masuk }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Jumlah kelas</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $value->jumlah_kelas }}</div>
                        </div>
                        <div class="row">
                            <div class="col">Jumlah siswa</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $value->jumlah_siswa }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@section('footer')
@endsection
