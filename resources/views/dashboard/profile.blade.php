@extends('layouts.index')
@section('title', 'Profile detail '.$user->username)
@section('content')
  <h1>{{ $user->username }}</h1>
  
  <div class="wrapper">
    <div class="card shadow border-0 rounded" style="width: 500px;background-color: #FFF">
      <div class="card-header p-3 d-flex justify-content-center" style="background-color: #FFF;">
        <img src="{{ asset('bg.png') }}" alt="profile-image" width="300px" height="300px">
      </div>
      <div class="card-body" style="background-color: #FFF;">
        <table>
          <tr>
            <td>Nama lengkap</td>
            <td>:</td>
            <td>Ujang</td>
          </tr>
        </table>
      </div>
      <div class="card-footer" style="background-color: #FFF;">
        <button class="btn btn-primary m-0">Edit</button>
        <button class="btn btn-danger m-0">Delete</button>
      </div>
    </div>
  </div>
@endsection