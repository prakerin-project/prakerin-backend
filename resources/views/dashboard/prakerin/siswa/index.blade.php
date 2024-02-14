@extends('layouts.index')
@section('title', 'Prakerin')
@section('content')
    <div class="row align-items-stretch justify-content-between gap-3">
        <div class="col-12 col-lg">
            <span class="d-flex align-items-center">
                <h1 class="d-inline m-0 lh-sm me-3">Prakerin</h1>
                <i class="d-inline iconsax" @style(['zoom: 1.5']) type="linear" stroke-width="1.5" icon="building-1"></i>
            </span>
            <div class="bg-primary rounded " @style(['height: 5px', 'width: 100%'])></div>
            {{-- PRAKERIN CARD SECTION --}}
            <div class="d-grid gap-3 mt-3" @style(['grid-template-columns: repeat(2, minmax(100px, auto))'])>

                @for ($i = 0; $i < 20; $i++)
                    <section class="card">
                        <div class="card-body position-relative">
                            <a href="#" class="stretched-link text-decoration-none link-dark">
                                <div class="m-0 card-title d-flex justify-content-between flex-wrap align-items-center">
                                    <h4 class="fw-bold m-0 lh-1">Prakerin {PT APA AJA}</h4>
                                    <span class="badge bg-primary fw-normal mt-1">{STATUS}</span>
                                </div>
                            </a>
                        </div>
                        <div class="card-footer">
                            <button onclick="flipCaretIcon({{ $i }})"
                                class="w-100 btn btn-sm btn-outline-primary d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" data-bs-target="#footer-collapse-{{ $i }}"
                                aria-expanded="false" aria-controls="footer-collapse-{{ $i }}">
                                Periode prakerin
                                <i class="iconsax" type="bold" id="caret-icon-{{ $i }}" @style(['zoom: 0.7']) type="linear"
                                    stroke-width="1.5" icon="chevron-down" ></i>
                            </button>
                            <div class="collapse mt-2" id="footer-collapse-{{ $i }}">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <span class="badge d-inline bg-success m-0 fw-normal">Tanggal mulai: {TANGGAL}</span>
                                    <span class="badge d-inline bg-danger m-0 fw-normal">Tanggal selesai: {TANGGAL}</span>
                                </div>
                            </div>
                        </div>
                    </section>
                @endfor

            </div>
            {{-- PRAKERIN CARD SECTION --}}
        </div>

        <div class="col-12 col-lg-auto order-first order-lg-last">
            {{-- DATA PRIBADI CARD --}}
            <div class="card sticky-top" @style(['scroll-padding-top: 100px', 'top: 95px'])>
                @isset($user->foto_profil)
                    <img src="{{ route('displayImage', ['uri' => $user->foto_profil, 'folder' => 'user']) }}" alt="foto-profil"
                        class="card-img-top mx-auto" @style(['object-fit' => 'cover', 'height: 100%', 'width: 300px'])>
                @endisset
                <div class="card-body ">
                    <div class="card-title">
                        <h2 class="fw-bold">Data Pribadi</h2>
                    </div>
                    <div class="card-text">
                        <div class="row">
                            <div class="col-5">NIS</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $siswa->nis }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5">Nama</div>
                            <div class="col-1">:</div>
                            <div class="col text-break">{{ $siswa->nama }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5">Jenis kelamin</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $siswa->jenis_kelamin }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5">No. telp</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $siswa->no_telp }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5">No. telp wali</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $siswa->no_telp_wali }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5">TTL</div>
                            <div class="col-1">:</div>
                            <div class="col">{{ $siswa->tempat_lahir . ', ' . $siswa->tanggal_lahir }}</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- DATA PRIBADI CARD --}}
        </div>
    </div>
@endsection
@section('footer')
    <script type="module">
        // get footer collapse id from clicked button
        window.flipCaretIcon = function(id) {
            //init current
            let current = $(`#caret-icon-${id}`);

            //run rotate accordingly
            current.data('rotate') === '180deg'
            ? current.animate({rotate: '0deg'}) && current.data('rotate', '0deg')
            : current.animate({rotate: '180deg'}) && current.data('rotate', '180deg');
        }
    </script>
@endsection
