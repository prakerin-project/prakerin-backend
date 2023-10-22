@extends('layouts.index')
@section('title', "Jenis Perusahaan $jenis_perusahaan->nama")
@section('content')
  <h1>Detail {{ $jenis_perusahaan->nama }}</h1>
  <h4>Jumlah perusahaan: {{ $jenis_perusahaan->perusahaan->count() }}</h4>

  {{-- <h5 class="mt-4">List perusahaan</h5> --}}
  <table class="table table-bordered">
    <thead style="background-color: #f4f4f5; height: 50px" class="w-100 rounded">
    <tr>
        <th class="text-uppercase">Nama Perusahaan</th>
        <th class="text-uppercase">Email</th>
        <th class="text-uppercase">Alamat</th>
        <th class="text-uppercase">Link website</th>
        <th class="text-uppercase">Foto</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jenis_perusahaan->perusahaan as $p)
        <tr>
            <td>{{$p->nama_perusahaan}}</td>
            <td>{{$p->email}}</td>
            <td>{{$p->alamat}}</td>
            <td>
              <a href="//{{$p->link_website}}" target="_blank">{{$p->link_website}}</a>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    @if(isset($p->foto) && count($p->foto) > 0)
                    <img src="{{url('storage/perusahaan/'.$p->foto[0]->path)}}" width="100px" height="100px" alt="Foto perusahaan" style="object-fit: cover;">
                    @else
                    No data available
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
@section('footer')
  <script type="module">
    $('.table').DataTable({
      paging: false,
    });
  </script>
@endsection