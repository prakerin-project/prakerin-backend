<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSiswa;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    use RequestTrait;

    public function getAll(Request $request)
    {
        $relation = $this->getRelation($request->input('relation', []), ['kelas', 'kaprog', 'pembimbing']);

        $pengajuan_siswa = PengajuanSiswa::query()->with($relation)->get();

        return response()->json($pengajuan_siswa, 200);
    }
    public function getById(int $id, string|array $relation = [])
    {
        $relation = $this->getRelation($relation, ['kelas', 'kaprog', 'pembimbing']);

        $jurusan = PengajuanSiswa::with($relation)->where('id_pengajuan', $id);

        return $jurusan;
    }
    function getOne(int $id, Request $request)
    {
        $jurusan = $this->getById($id, $request->input('relation', []));

        return response()->json($jurusan, 200);
    }
    function create() {
        
    }
}
