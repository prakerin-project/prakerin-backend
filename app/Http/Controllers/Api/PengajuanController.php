<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\pengajuan\CreatePengajuanSiswaRequest;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;
use App\Models\User;
use App\Traits\RequestTrait;
use Auth;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    use RequestTrait;

    public function getAll(Request $request)
    {
        $pengajuan_siswa = PengajuanSiswa::query()->with('siswa');

        if (isset($request->status))
        {
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
        $user            = User::query()->find($request->id_user);
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
        if (!$walas_siswa || !$kaprog_siswa)
        {
            return response()->json(['message' => 'Jurusan atau kelas ada yang tidak lengkap. Tolong segera hubungi admin.'], 400);
        }

        $siswa = $user->load('siswa')->siswa;

        // count pengajuan with same nis siswa
        $count       = PengajuanSiswa::where('nis_siswa', $siswa->nis)->count();
        $pengajuanId = 'p_' . $user->load('siswa')->siswa->nis . '_' . $count + 1;

        //create pengajuan
        $pengajuan = Pengajuan::query()->create(
            array_merge($data, [
                'id'         => $pengajuanId,
                'nip_walas'  => $walas_siswa,
                'nip_kaprog' => $kaprog_siswa,
            ]),
        );


        //loop over nis siswa to create pengajuan for each of siswa
        foreach ($request->nis_siswa as $nis)
        {
            $pengajuan_siswa->create(['id_pengajuan' => $pengajuanId, 'nis_siswa' => $nis]);
        }
        return response()->json($pengajuan, 201);
    }
}
