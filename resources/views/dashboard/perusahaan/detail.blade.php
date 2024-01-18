@extends('layouts.index')
@section('title', "$perusahaan->nama_perusahaan")
@section('content')
    <div class="row d-flex gap-1 flex-row-reverse">
        @if ($perusahaan->foto->count() >= 1)
            <div class="col-7 foto-wrapper d-flex flex-column">
                <img src="{{ route('displayImage', ['uri' => $perusahaan->foto[0]->path, 'folder' => 'perusahaan']) }}"
                    style="object-fit: cover;" class="main-foto rounded" alt="first-image" height="430px">
                <div class="small-foto d-flex mt-2 gap-2">
                    @foreach ($perusahaan->foto as $key => $foto)
                        {{-- Get all the foto except the first one --}}
                        @php
                            if ($key === 0) {
                                continue;
                            }
                        @endphp
                        <img alt="foto-perusahaan" src="{{ route('displayImage', ['uri' => $foto->path, 'folder' => 'perusahaan']) }}"
                            style="object-fit: cover;" width="120px" height="100px" class="rounded">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="col border rounded p-0 h-50">
            <h1 class="border-bottom p-2">Detail perusahaan</h1>
            <table class="fs-6 fw-lighter m-2">
                <tr>
                    <td>Nama</td>
                    <td class="px-2">:</td>
                    <td>{{ $perusahaan->nama_perusahaan }}</td>
                </tr>
                <tr>
                    <td>Jenis Perusahaan</td>
                    <td class="px-2">:</td>
                    <td>{{ $perusahaan->jenis_perusahaan->nama }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="px-2">:</td>
                    <td>{{ $perusahaan->email }}</td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td class="px-2">:</td>
                    <td><a href="{{ $perusahaan->link_website }}">{{ $perusahaan->link_website }}</a></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td class="px-2">:</td>
                    <td>{{ $perusahaan->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
