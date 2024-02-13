 @extends('layouts.index')
 @section('title', 'Pengajuan')
 @section('content')

     <div class="row">
         <h1>Pengajuan</h1>
     </div>
     <div class="row mb-4">
         <div class="col-3">
             <a href="{{ url('/dashboard/pengajuan/semua') }}" class="text-decoration-none">
                 <div class="card border-0" style="background-color: #006fee">
                     <div class="card-body d-flex text-white" style="height: 120px">
                         <div class="w-100 d-flex flex-column justify-content-center">
                             <h1>{{ $totalPengajuan }}</h1>
                             <h4 class="m-0">Semua pengajuan</h4>
                         </div>
                         <div class="d-flex justify-content-end">
                             <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="bar-chart-1"></i>
                         </div>
                     </div>
                 </div>
             </a>
         </div>
         <div class="col-3">
             <a href="{{ url('/dashboard/pengajuan/pending') }}" class="text-decoration-none">
                 <div class="card border-0" style="background-color: #7828c8">
                     <div class="card-body d-flex text-white" style="height: 120px">
                         <div class="w-100 d-flex flex-column justify-content-center">
                             <h1>{{ $totalPending }}</h1>
                             <h4 class="m-0">Pengajuan pending</h4>
                         </div>
                         <div class="d-flex justify-content-end">
                             <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="hourglass"></i>
                         </div>
                     </div>
                 </div>
             </a>
         </div>
         <div class="col-3">
             <a href="{{ url('/dashboard/pengajuan/diterima') }}" class="text-decoration-none">
                 <div class="card border-0" style="background-color: #17c964">
                     <div class="card-body d-flex text-white" style="height: 120px">
                         <div class="w-100 d-flex flex-column justify-content-center">
                             <h1>{{ $totalDiterima }}</h1>
                             <h4 class="m-0">Pengajuan diterima</h4>
                         </div>
                         <div class="d-flex justify-content-end">
                             <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5" icon="clipboard-tick"></i>
                         </div>
                     </div>
                 </div>
             </a>
         </div>
         <div class="col-3">
             <a href="{{ url('/dashboard/pengajuan/ditolak') }}" class="text-decoration-none">
                 <div class="card border-0" style="background-color: #f31620;">
                     <div class="card-body d-flex text-white" style="height: 120px">
                         <div class="w-100 d-flex flex-column justify-content-center">
                             <h1>{{ $totalDitolak }}</h1>
                             <h4 class="m-0">Pengajuan ditolak</h4>
                         </div>
                         <div class="d-flex justify-content-end">
                             <i class="iconsax" style="zoom: 2" type="linear" stroke-width="1.5"
                                 icon="clipboard-close"></i>
                         </div>
                     </div>
                 </div>
             </a>
         </div>
     </div>
     <div class="row">
         <div class="col">
             <h3>Daftar pengajuan hari ini</h3>
             <table class="table table-bordered rounded overflow-hidden">
                 <thead class="table-secondary">
                     <tr>
                         <th>Tanggal</th>
                         <th>Status</th>
                         <th>Siswa</th>
                         <th>Perusahaan</th>
                         <th>Alamat</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($data as $pengajuan)
                         <tr>
                             <td>{{ $pengajuan->created_at }}</td>
                             <td>{{ $pengajuan->status }}</td>
                             <td>{{ $pengajuan->siswa->nama }}</td>
                             <td>{{ $pengajuan->nama_industri }}</td>
                             <td>{{ $pengajuan->alamat_industri }}</td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
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
