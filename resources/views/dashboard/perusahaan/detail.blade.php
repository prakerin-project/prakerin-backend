@extends('layouts.index')
@section('title', "$perusahaan->nama_perusahaan")
@section('content')
  <h1>Detail Perusahaan</h1>
  <div class="d-flex gap-4">
    @if ($perusahaan->foto->count() > 1)
    <div class="foto-wrapper d-flex flex-column">
      <img src="{{ asset("storage/perusahaan/".$perusahaan->foto[0]->path) }}" style="object-fit: cover;" class="main-foto" alt="first-image" width="500px" height="400px">
      <div class="small-foto d-flex mt-2 gap-2">
        @foreach ($perusahaan->foto as $foto )
        <img src="{{ asset('storage/perusahaan/'.$foto->path) }}" style="object-fit: cover;" width="120px" height="100px">
          
        @endforeach
      </div>
    </div>
    @endif
  
    <div>
      <h2>Nama Perusahaan : {{ $perusahaan->nama_perusahaan }}</h2>
      <h2>Jenis Perusahaan : {{ $perusahaan->jenis_perusahaan->nama }}</h2>
      <h2>Contact : {{ $perusahaan->email }}</h2>
      <h2>Alamat : {{ $perusahaan->alamat }}</h2>
    </div>
  </div>
@endsection