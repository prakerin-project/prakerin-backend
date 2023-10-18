@extends("layouts.index")
@section("title", "$user_detail->nama")

@section("content")
    <div>
        <h1>{{ $user_detail->nama }}</h1>
        <div class="row">
            <div class="col-6 vh-100">
                <div class="card w-100 bg-white">
                    <img src="/.png" class="card-img-top" alt="{{ $user_detail->nama }}">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="row pt-1 border-top mt-2">
                                <div class="col">Username</div>
                                <div class="col-1">:</div>
                                <div class="col">{{ $user->username }}</div>
                            </div>
                            <div class="row">
                                <div class="col">Role</div>
                                <div class="col-1">:</div>
                                <div class="col">{{ $user->role }}</div>
                            </div>
                            @foreach ($user_detail_key as $key)
                                <div class="row">
                                    <div class="col">{{$key}}</div>
                                    <div class="col-1">:</div>
                                    <div class="col">{{ $user_detail[$key] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mx-1 mt-3">
                            <div class="col-9 p-0">
                                <a href="#" class="col w-100 rounded-start-pill btn btn-primary">Edit</a>
                            </div>
                            <div class="col-3 p-0">
                                <a href="#" class="col d-flex align-items-center gap-2 w-100 rounded-end-pill btn btn-danger">
                                    <i class="iconsax text-light" type="linear" icon="trash" style="zoom: 0.8"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 vh-100"></div>
        </div>
    </div>
@endsection
