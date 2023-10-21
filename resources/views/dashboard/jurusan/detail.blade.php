@extends("layouts.index")
@section("title", "$jurusan->akronim")

@section("content")
    <div class="row">
        <div class="col vh-100">
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
        <div class="col vh-100">
            <div class="card">
                <div class="card-header">
                    <h1>Data siswa jurusan {{ $jurusan->nama_jurusan }}</h1>
                </div>
                <div class="card-body">
                    <div class="px-3">
                        <div class="row pt-1 mt-2 mb3 border-bottom">
                            <div class="col">Jumlah Murid</div>
                            <div class="col-1">:</div>
                            <div class="col">@php echo sizeOf($siswa) @endphp</div>
                        </div>
                        @foreach ($siswa as $s)
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
