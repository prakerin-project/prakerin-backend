@extends('layouts.index')
@section('title', 'Pengajuan')
@section('content')

    <div class="row mb-3">
        <div class="col  d-flex justify-content-between align-items-center">
            <h1>Pengajuan Saya</h1>
            <a href="{{ url('/dashboard/pengajuan/tambah') }}" class="btn btn-primary"><i class="iconsax" type="linear"
                    stroke-width="1.5" icon="clipboard-text"></i>Tambah Pengajuan</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div style="columns: 12rem; column-gap: 10px">
                @for ($i = 0; $i < 10; $i++)
                    <div class="card mb-3" style="break-inside: avoid-column">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script type="module">
        $('.table').DataTable({
            paging: false
        })
    </script>
@endsection
