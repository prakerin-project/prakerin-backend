@extends('layouts.index')
@section('title', 'User ' . request('role'))
@section('content')
    <div class="rounded-0 card rounded-top-5 mb-3">
        <div class="card-body">
            <div class="px-3 d-flex flex-row justify-content-center align-items-center">
                <p class="d-inline text-capitalize h1 text-primary me-auto ">{{ request('role') }}</p>
                <i class="iconsax text-primary" style="zoom: 4;" type="bold" stroke-width="1.5" icon="user"></i>
                <div class="text-primary" style="font-size:10rem;line-height:10rem">
                    @php echo $data ?sizeOf($data):0 @endphp</div>
            </div>
        </div>
    </div>
    <div style="columns: 16rem;">
        @forelse ($data as $role)
            <a href="{{ url('dashboard/user/' . $role->id_user . '?role=' . $role->user->role) }}"
                class="text-dark link-underline link-underline-opacity-0">
                <div class="card" style="break-inside: avoid-column">
                    <div class="card-header">
                        <h1>{{ $role->user->username }}</h1>
                    </div>
                    @isset($role->user->foto_profil)
                        <img src="{{ route('displayImage', ['uri' => $role->user->foto_profil, 'folder' => 'user']) }}"
                            alt="User photo">
                    @endisset
                    <div class="card-body text-capitalize">
                        <p class="text-decoration-underline mb-0"> Click to see detail</p>
                        <p>Been here since, {{ $role->user->created_at }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="card" style="break-inside: avoid-column; column-span:all;">
                <div class="card-body text-capitalize mx-auto d-inline-flex align-items-center ">
                    <i class="iconsax text-danger" style="zoom:2;" type="linear" stroke-width="1.5"
                        icon="user-round-delete"></i>
                    <p class="h2 m-0 text-center text-danger">Belum ada user</p>
                </div>
            </div>
        @endforelse
    </div>
    <div class="rounded-0 card rounded-bottom-5 mt-3" style="height: 10rem;""></div>
@endsection
