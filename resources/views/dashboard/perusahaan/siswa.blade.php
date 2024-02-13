@extends('layouts.index')
@section('title', 'List Perusahaan')

@section('content')
    <div class="row gap-3">
        @foreach ($perusahaan as $p)
            <div class="card bg-white p-0" style="width: 18rem; display: inline-block">
                <div style="height: 250px" class="d-flex border-bottom object-fit-contain">
                    @if ($p->foto->count() > 0)
                        <img src="{{ route('displayImage', ['uri' => $p->foto[0]->path, 'folder' => 'perusahaan']) }}"
                            class="card-img-top object-fit-contain" alt="foto_perusahaan">
                    @else
                        <img src="{{ asset('perusahaan_default.png') }}" class="card-img-top" alt="foto_perusahaan">
                    @endif
                </div>
                <div class="card-body p-3">
                    <h3 class="card-title fw-semibold">{{ $p->nama_perusahaan }}</h3>
                    <div style="color: rgb(94, 94, 94)">
                        <div class="d-flex gap-1">
                            <i class="iconsax" type="linear" style="zoom: 0.8" stroke-width="1.5" icon="buildings-2"></i>
                            <p class="card-text">{{ $p->jenis_perusahaan->nama }}</p>
                        </div>
                        <div class="d-flex gap-1">
                            <i class="iconsax" type="linear" style="zoom: 0.8" stroke-width="1.5" icon="mail"></i>
                            <p class="card-text m-0">{{ $p->email }}</p>
                        </div>
                        <div class="d-flex gap-1">
                            <i class="iconsax" type="linear" style="zoom: 0.8" stroke-width="1.5" icon="global"></i>
                            <a href="{{ $p->link_website }}"
                                class="card-text text-decoration-none">{{ $p->link_website }}</a>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <a href="{{ url("/dashboard/perusahaan/$p->id") }}"
                        class="btn w-100 btn-primary text-bg-primary">Detail</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('footer')
@endsection
