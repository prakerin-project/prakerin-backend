@extends('layouts.index')
@section('title', 'One Prakerin')
{{-- TODO: Responsive --}}
@section('content')
    <section class="row mb-5">
        <div class="col-md-6 col-12">
            <div class="w-auto shadow-lg rounded w-auto " @style(['clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 0, 0% 0%);', 'height: 15rem'])>
                <img src="{{ asset('smk1bekasi.jpg') }}" alt="SMKN 1 Kota Bekasi" width="100%" height="100%"
                    @style(['object-fit: cover']) draggable="false">
            </div>
        </div>
        <div class="col-md-6 col-12 d-flex justify-content-center flex-column">
            <h1 class="fs-1 text-primary mb-0 fw-bold">SMK Negeri 1 Kota Bekasi</h1>
            <p class="fs-4 fst-italic">Paling bisa!</p>
        </div>
    </section>
    <section>
        <h2 class="fs-4 position-relative">
            <span class="position-relative fs-1 ">
                <span @style(['position: absolute', 'bottom: .65rem', 'right: -100%', 'width: 100%', 'height: .5rem', 'background-color: var(--bs-primary)', 'z-index: -1'])></span>
                Prakerin bersama,
            </span>
            <span @style(['position: absolute', 'bottom: .8rem', 'word-spacing: 1rem', 'letter-spacing: .2rem'])>
                tanpa masalah.
            </span>
        </h2>
        <h5>Perusahaan yang direkomendasikan untuk anda:</h5>
        <div class="d-flex flex-row flex-wrap gap-3">
            @foreach ($perusahaan as $psh)
                <a href="{{ url('/dashboard/perusahaan/' . $psh->id) }}">
                    <div class="btn btn-primary">
                        {{ $psh->nama_perusahaan }}
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
@section('footer')
    <script type="module">
        // console.log(<?= $perusahaan ?>);
    </script>
@endsection
