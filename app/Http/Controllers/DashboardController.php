<?php

namespace App\Http\Controllers;

use App\Models\JenisPerusahaan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Logs;
use App\Models\Perusahaan;
use App\Models\Siswa;
use App\Models\User;
use App\Traits\RoleToRelationTrait;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use RoleToRelationTrait;
    /**
     * Index function
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.index');
    }

    public function log()
    {
        $data = [
            'logs' => Logs::orderBy('created_at')->get()
        ];

        return view('dashboard.log', $data);
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
            'angkatan' => Kelas::with('siswa')->orderByDesc('angkatan')->get()->groupBy('angkatan')
        ];

        return view('dashboard.kelas.index', $data);
    }
}