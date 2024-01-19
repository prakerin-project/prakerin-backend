<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\pengajuan\CreatePengajuanSiswaRequest;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;
use App\Traits\RequestTrait;
use Auth;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    use RequestTrait;

    public function getAll(Request $request)
    {
        $pengajuan_siswa = PengajuanSiswa::query()->with('siswa');

        if (isset($request->status)) {
            $status          = $request->status;
            $pengajuan_siswa = $pengajuan_siswa->where('status', $status);
        }

        return response()->json($pengajuan_siswa->get(), 200);
    }
    public function getById(int $id, string|array $relation = [])
    {
        $relation = $this->getRelation($relation, ['kelas', 'kaprog', 'pembimbing']);

        $jurusan = PengajuanSiswa::with($relation)->where('id_pengajuan', $id);

        return $jurusan;
    }
    public function getOne(int $id, Request $request)
    {
        $jurusan = $this->getById($id, $request->input('relation', []));

        return response()->json($jurusan, 200);
    }
    public function create(CreatePengajuanSiswaRequest $request)
    {
        //init models
        $user            = Auth::user();
        $pengajuan_siswa = PengajuanSiswa::query();

        //assign needed variable
        //TODO: known vulnerability, jurusan or kelas may not have a headmaster
        $walas_siswa  = $user->load('siswa.kelas.walas')->siswa->kelas->walas->nip;
        $kaprog_siswa = $user->load('siswa.kelas.jurusan.kaprog')->siswa->kelas->jurusan->kaprog->nip;
        $data         = $request->except('nis_siswa');

        /**
         * TODO: omit extra validation by fixing database,
         * fix changing the flow upon kelas creation and jurusan creation;
         * add walas or kaprog in one creation flow of both.
         * will also fix vulnerability
         */
        if (!$walas_siswa || !$kaprog_siswa) {
            return response()->json(['message' => 'Jurusan atau kelas ada yang tidak lengkap. Tolong segera hubungi admin.'], 400);
        }

        //create pengajuan
        $pengajuan = Pengajuan::query()->create(
            array_merge($data, [
                'nip_walas'  => $walas_siswa,
                'nip_kaprog' => $kaprog_siswa
            ])
        );

        //loop over nis siswa to create pengajuan for each of siswa
        foreach ($request->only('nis_siswa') as $nis) {
            $pengajuan_siswa->create(['id_pengajuan' => $pengajuan->id, 'nis_siswa' => $nis]);
        }
        return response()->json($pengajuan->with('siswa')->getChanges(), 201);
    }
}
