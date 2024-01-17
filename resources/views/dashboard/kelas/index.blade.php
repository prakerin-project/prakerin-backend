@extends('layouts.index')
@section('title', 'Daftar Kelas')
@section('content')
  <div class="row row-gap-4">
    @forelse($angkatan as $key => $value)
    <div class="col-3">
      <a class="card" style="text-decoration: none;" href="" onmouseover="this.classList.add('shadow')" onmouseout="this
      .classList.remove('shadow')">
        <div class="card-header bg-primary text-light">
          <h1 class="m-0">{{$key}}</h1>
        </div>
        <div class="card-body bg-white rounded-2">
          <div class="row">
            <div class="col">Tahun masuk</div>
            <div class="col-1">:</div>
            <div class="col"></div>
          </div>
          <div class="row">
            <div class="col">Jumlah kelas</div>
            <div class="col-1">:</div>
            <div class="col">{{$value->count()}}</div>
          </div>
          <div class="row">
            <div class="col">Jumlah siswa</div>
            <div class="col-1">:</div>
            <div class="col"></div>
          </div>
        </div>
      </a>
    </div>
    @empty
    <p>Belum ada kelas.</p>
    @endforelse
  </div>
@endsection
@section('footer')
@endsection