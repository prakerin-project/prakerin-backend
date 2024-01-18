<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserController;
use App\Models\JenisPerusahaan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Logs;
use App\Models\PengajuanSiswa;
use App\Models\Perusahaan;
use App\Models\Siswa;
use App\Models\User;
use App\Traits\RequestTrait;
use App\Traits\RoleToRelationTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    use RoleToRelationTrait;
    use RequestTrait;
    /**
     * Index function
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.index');
    }
    public function perusahaan()
    {
        $data = [
            'perusahaan'       => Perusahaan::with('jenis_perusahaan', 'foto')->orderBy('nama_perusahaan')->get(),
            'jenis_perusahaan' => JenisPerusahaan::all()
        ];

        return view('dashboard.perusahaan.index', $data);
    }
    public function perusahaanDetail($id)
    {
        $data = [
            'perusahaan' => Perusahaan::query()->with('jenis_perusahaan', 'foto')->findOrFail($id)
        ];

        return view('dashboard.perusahaan.detail', $data);
    }
    public function log()
    {
        $data = [
            'logs' => Logs::orderBy('created_at')->get()
        ];

        return view('dashboard.log', $data);
    }
    public function user()
    {
        $data = [
            'users' => User::all()->sortDesc()
        ];

        return view('dashboard.user.index', $data);
    }
    public function userDetail(Request $request)
    {
        $relation = $this->roleToRelation($request->role);
        $user     = User::with($relation)->has($relation[0])->findOrFail($request->id);

        foreach ($user->getRelation($relation[0])->makeHidden(['id_user', 'id_kelas', 'id_jurusan'])->toArray() as $key => $value) {
            $user_detail[] = $key;
        }

        $data = [
            'user'            => $user,
            'user_detail_key' => $user_detail,
            'user_detail'     => $user->getRelation($relation[0])
        ];
        return view('dashboard.user.detail', $data);
    }
    public function userEdit(Request $request)
    {
        $relation = $this->roleToRelation($request->role);
        $user     = User::with($relation)->has($relation[0])->findOrFail($request->id);

        foreach ($user->getRelation($relation[0])->makeHidden(['id_user', 'id_kelas', 'id_jurusan'])->toArray() as $key => $value) {
            $user_detail[] = $key;
        }

        $data = [
            'user'            => $user,
            'user_detail_key' => $user_detail,
            'user_detail'     => $user->getRelation($relation[0])
        ];
        return view('dashboard.user.edit', $data);
    }
    public function userRole(string $role)
    {
        $data = ['data' => UserController::getRoleModel($role)->newQuery()->with('user')->get()];
        // return $data;
        return view('dashboard.role.index', $data);
    }
    public function jurusan()
    {
        $data = [
            'all_jurusan' => Jurusan::all()
        ];

        return view('dashboard.jurusan.index', $data);
    }
    public function jurusanDetail($id)
    {
        // return Siswa::query()->getRelation('kelas')->whereIdJurusan($id)->with(['siswa','siswa.user'])->firstOrFail()->toArray()['siswa'];
        $siswa = Siswa::query()->getRelation('kelas')->whereIdJurusan($id)->with(['siswa', 'siswa.user'])->first() ?? [];
        if ($siswa) {
            $siswa = $siswa->toArray()['siswa'];
        }
        $data = [
            'jurusan' => Jurusan::findOrFail($id),
            'siswa'   => $siswa,
            // 'siswa_count' => Siswa::query()->withWhereHas('kelas',fn($query)=>$query->where('id_jurusan',$id)->get()),
        ];

        return view('dashboard.jurusan.detail', $data);
    }
    function kelas()
    {
        $data = [
            'data' => DB::select('SELECT * FROM angkatan_view')
        ];

        return view('dashboard.kelas.index', $data);
    }
    function jenisPerusahaan()
    {
        $data = [
            'jenis_perusahaan' => JenisPerusahaan::with('perusahaan')->orderBy('nama')->get(),
        ];

        return view('dashboard.jenis-perusahaan.index', $data);
    }
    function jenisPerusahaanDetail(int $id, $relation = [])
    {
        $data = [
            'jenis_perusahaan' => JenisPerusahaan::with('perusahaan')->findOrFail($id),
        ];

        return view('dashboard.jenis-perusahaan.detail', $data);
    }
    function pengajuan()
    {
        $data = ['data' => PengajuanSiswa::with('pengajuan', 'siswa')->get()];
        return view('dashboard.pengajuan.index', $data);
    }
}