@extends('layouts.index')
@section('title', "$perusahaan->nama_perusahaan")
@section('content')
  <h1>Detail Perusahaan</h1>
  <div class="row d-flex">
    @if ($perusahaan->foto->count() >= 1)
    <div class="col foto-wrapper d-flex flex-column">
      <img src="{{ asset("storage/perusahaan/".$perusahaan->foto[0]->path) }}" style="object-fit: cover;"
           class="main-foto rounded" alt="first-image" height="430px">
      <div class="small-foto d-flex mt-2 gap-2">
        @foreach ($perusahaan->foto as $key => $foto )
            {{-- Get all the foto except the first one --}}
            @php
            if ($key === 0){
                break;
            }
            @endphp
            <img alt="foto-perusahaan" src="{{ asset('storage/perusahaan/'.$foto->path) }}" style="object-fit: cover;"
                 width="120px"
                  height="100px">
        @endforeach
      </div>
    </div>
    @endif

    <div class="col">
      <h2>Nama Perusahaan : {{ $perusahaan->nama_perusahaan }}</h2>
      <h2>Jenis Perusahaan : {{ $perusahaan->jenis_perusahaan->nama }}</h2>
      <h2>Email : {{ $perusahaan->email }}</h2>
      <h2>Alamat : {{ $perusahaan->alamat }}</h2>
    </div>
  </div>
@endsection
