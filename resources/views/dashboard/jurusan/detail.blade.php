@extends('layouts.index')
@section('title', "$jurusan->akronim")

@section('content')
    <div class="row gy-4 ">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1>{{ $jurusan->nama_jurusan }}</h1>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <div class="row pt-1 mt-2">
                            <div class="col">Nama Jurusan</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $jurusan->nama_jurusan }}</div>
                        </div>
                        <div class="row pt-1">
                            <div class="col">Akronim</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $jurusan->akronim }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                {{-- <div class="card-header">
                    <h1>Jumlah siswa jurusan {{ $jurusan->nama_jurusan }}</h1>
                </div> --}}
                <div class="card-body">
                    <div class="px-3 d-flex justify-content-center align-items-center">
                        <i class="iconsax text-primary" style="zoom: 4;" type="bold" stroke-width="1.5"
                            icon="user"></i>
                        <div class="text-primary" style="font-size:10rem;line-height:10rem">
                            @php echo $siswa ?sizeOf($siswa):0 @endphp</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="card p-0">
                    <div class="card-header">
                        <h1>Data siswa jurusan {{ $jurusan->nama_jurusan }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="px-3">
                            <div class="row pt-1 mt-2 mb3 border-bottom">
                                <div class="col">Jumlah Murid</div>
                                <div class="col-1">:</div>
                                <div class="col">@php echo $siswa ?sizeOf($siswa):0 @endphp</div>
                            </div>
                            @forelse ($siswa as $s)
                                <div class="row pt-1 mt-2">
                                    <div class="col">Nama</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $s['nama'] }}</div>
                                </div>
                                <div class="row pt-1 mt-2">
                                    <div class="col">NIS</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $s['nis'] }}</div>
                                </div>
                                <div class="row pt-1 mt-2">
                                    <div class="col">Username</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $s['user']['username'] }}</div>
                                </div>
                                <div class="row pt-1 mt-2">
                                    <div class="col">Jenis Kelamin</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $s['jenis_kelamin'] }}</div>
                                </div>
                                <div class="row pt-1 mt-2 border-bottom">
                                    <div class="col">Tempat, Tanggal Lahir</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $s['tempat_lahir'] }}, {{ $s['tanggal_lahir'] }}</div>
                                </div>
                            @empty
                                <p class="mt-3 ">Belum ada siswa</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
