<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $data = PengajuanSiswa::with('pengajuan', 'siswa')->get();

        return view('dashboard.pengajuan.index', $data);
    }
}
