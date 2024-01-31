@extends('layouts.index')
@section('title', 'List Perusahaan')

@section('content')
    <div class="row">

        @foreach ($perusahaan as $p)
            <div class="col-6">
                <a href="{{ url('dashboard/perusahaan/' . $p->id) }}"
                    class="border p-3 text-decoration-none color gap-3 text-black rounded d-flex">
                    @if ($p->foto->count() >= 1)
                        <img src="{{ route('displayImage', ['uri' => $p->foto[0]->path, 'folder' => 'perusahaan']) }}"
                            class="rounded object-fit-contain" width="150px" height="150px" alt="Perusahaan Image">
                    @else
                        <img src="{{ asset('bg.png') }}" class="rounded object-fit-cover" width="150px" height="150px"
                            alt="Perusahaan Image">
                    @endif
                    <div>
                        <h1 class="fs-3">{{ $p->nama_perusahaan }}</h1>
                        <div class="d-flex gap-1" style="color: rgb(105, 105, 105)">
                            <i class="iconsax" type="linear" style="zoom: 0.7" stroke-width="1.5" icon="buildings-1"></i>
                            <p class="m-0">{{ $p->jenis_perusahaan->nama }}</p>
                        </div>
                        <div class="d-flex gap-1" style="color: rgb(105, 105, 105)">
                            <i class="iconsax" type="linear" style="zoom: 0.7" stroke-width="1.5" icon="mail"></i>
                            <p class="m-0">{{ $p->email }}</p>
                        </div>
                        <div class="text-primary d-flex gap-1">
                            <i class="iconsax" type="linear" style="zoom: 0.7" stroke-width="1.5" icon="global"></i>
                            <p class="m-0">{{ $p->link_website }}</p>
                        </div>
                        <div class="d-flex gap-1 mt-3">
                            <i class="iconsax text-danger" type="linear" style="zoom: 0.7" stroke-width="1.5"
                                icon="location-pin"></i>
                            <p class="m-0">{{ $p->alamat }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection

@section('footer')
@endsection
