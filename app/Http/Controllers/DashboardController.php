<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\UserController;
use App\Models\JenisPerusahaan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Logs;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;
use App\Models\Perusahaan;
use App\Models\Prakerin;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Walas;
use App\Traits\RequestTrait;
use App\Traits\RoleToRelationTrait;
use Auth;
use Illuminate\Contracts\View\View;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use RoleToRelationTrait;
    use RequestTrait;
    /**
     * Index function
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $data = [];
        if ($request->user()->role == 'siswa')
        {
            $data = [
                // 'prakerin'   => Prakerin::where('nis_siswa', $request->user()->id)->get(),
                'perusahaan' => Perusahaan::inRandomOrder()->limit(5)->get(),
            ];
        }
        return $request->user()->role == 'siswa'
            ? view('dashboard.siswa', $data)
            : view('dashboard.index', $data);
    }
    public function perusahaan()
    {
        $data = [
            'perusahaan'       => Perusahaan::with('jenis_perusahaan', 'foto')->orderBy('nama_perusahaan')->get(),
            'jenis_perusahaan' => JenisPerusahaan::all(),
        ];

        if (auth()->user()->role == 'siswa')
        {
            return view('dashboard.perusahaan.siswa', $data);
        }

        return view('dashboard.perusahaan.index', $data);
    }
    public function perusahaanDetail($id)
    {
        $data = [
            'perusahaan' => Perusahaan::query()->with('jenis_perusahaan', 'foto')->findOrFail($id),
        ];

        return view('dashboard.perusahaan.detail', $data);
    }
    public function log()
    {
        $data = [
            'logs' => Logs::orderBy('created_at', 'desc')->get(),
        ];

        return view('dashboard.log', $data);
    }
    public function user()
    {
        $data = [
            'users' => User::all()->sortDesc(),
        ];

        return view('dashboard.user.index', $data);
    }
    public function userDetail(Request $request)
    {
        $relation = $this->roleToRelation($request->role);
        $user     = User::with($relation)->has($relation[0])->findOrFail($request->id);

        foreach ($user->getRelation($relation[0])->makeHidden(['id_user', 'id_kelas', 'id_jurusan'])->toArray() as $key => $value)
        {
            $user_detail[] = $key;
        }

        $data = [
            'user'            => $user,
            'user_detail_key' => $user_detail,
            'user_detail'     => $user->getRelation($relation[0]),
        ];
        return view('dashboard.user.detail', $data);
    }
    public function userEdit(Request $request)
    {
        $relation = $this->roleToRelation($request->role);
        $user     = User::with($relation)->has($relation[0])->findOrFail($request->id);

        foreach ($user->getRelation($relation[0])->makeHidden(['id_user', 'id_kelas', 'id_jurusan'])->toArray() as $key => $value)
        {
            $user_detail[] = $key;
        }

        $data = [
            'user'            => $user,
            'user_detail_key' => $user_detail,
            'user_detail'     => $user->getRelation($relation[0]),
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
            'all_jurusan' => Jurusan::all(),
        ];

        if (auth()->user()->role == 'siswa')
        {
            $user           = Siswa::where('id_user', auth()->user()->id)->first();
            $siswaInJurusan = Siswa::query()->getRelation('kelas')->whereIdJurusan($user->kelas->jurusan->id)->with(['siswa', 'siswa.user'])->first() ?? [];
            if ($siswaInJurusan)
            {
                $siswaInJurusan = $siswaInJurusan->toArray()['siswa'];
            }
            $data = [
                'jurusan' => Jurusan::where('id', $user->kelas->jurusan->id)->firstOrFail(),
                'siswa'   => $siswaInJurusan,
            ];

            return view('dashboard.jurusan.siswa', $data);
        }

        return view('dashboard.jurusan.index', $data);
    }
    public function jurusanDetail($id)
    {
        // return Siswa::query()->getRelation('kelas')->whereIdJurusan($id)->with(['siswa','siswa.user'])->firstOrFail()->toArray()['siswa'];
        $siswa = Siswa::query()->getRelation('kelas')->whereIdJurusan($id)->with(['siswa', 'siswa.user'])->first() ?? [];
        if ($siswa)
        {
            $siswa = $siswa->toArray()['siswa'];
        }
        $data = [
            'jurusan' => Jurusan::findOrFail($id),
            'siswa'   => $siswa,
            // 'siswa_count' => Siswa::query()->withWhereHas('kelas',fn($query)=>$query->where('id_jurusan',$id)->get()),
        ];

        return view('dashboard.jurusan.detail', $data);
    }
    public function kelas()
    {
        $data = [
            'kelas'   => Kelas::with('jurusan')->orderByDesc('angkatan')->get(),
            'jurusan' => Jurusan::all(),
        ];

        if (auth()->user()->role == 'siswa')
        {
            $siswa = Siswa::where('id_user', auth()->user()->id)->first();
            $data  = [
                'kelas'   => Kelas::with(['jurusan', 'siswa'])->findOrFail($siswa->kelas->id),
                'walas'   => Walas::with(['kelas', 'user'])->where('id_kelas', $siswa->kelas->id)->first(),
                'jurusan' => Jurusan::all(),
            ];

            return view('dashboard.kelas.siswa', $data);
        }

        return view('dashboard.kelas.index', $data);
    }
    public function kelasDetail(int $id)
    {
        $data = [
            'kelas'   => Kelas::with([
                'jurusan',
                'siswa' => function ($query) {
                    $query->orderBy('nama');
                }
            ])->findOrFail($id),
            'walas'   => Walas::with(['kelas', 'user'])->where('id_kelas', $id)->first(),
            'jurusan' => Jurusan::all(),
        ];

        return view('dashboard.kelas.detail', $data);
    }
    public function jenisPerusahaan()
    {
        $data = [
            'jenis_perusahaan' => JenisPerusahaan::with('perusahaan')->orderBy('nama')->get(),
        ];

        return view('dashboard.jenis-perusahaan.index', $data);
    }
    public function jenisPerusahaanDetail(int $id)
    {
        $data = [
            'jenis_perusahaan' => JenisPerusahaan::with('perusahaan')->findOrFail($id),
        ];

        return view('dashboard.jenis-perusahaan.detail', $data);
    }
    public function pengajuan()
    {
        $userRole       = auth()->user()->role;
        $allowedPending = ['belum_diterima', 'diterima', 'diajukan'];

        switch ($userRole)
        {
            case 'hubin':
                $data = [
                    'data'           => PengajuanSiswa::with([
                        'siswa',
                        'pengajuan' => function ($q) {
                            $q->where('created_at' == now()->subDay())->orderBy('created_at', 'desc');
                        }
                    ])->get(),
                    'totalPengajuan' => PengajuanSiswa::count(),
                    'totalPending'   => Pengajuan::whereIn('status', $allowedPending)->count(),
                    'totalDiterima'  => Pengajuan::where('status', 'diterima')->count(),
                    'totalDitolak'   => Pengajuan::where('status', 'ditolak')->count(),
                ];
                return view('dashboard.pengajuan.hubin.index', $data);
            case 'siswa':
                $data = ['data' => PengajuanSiswa::with('pengajuan', 'siswa')->where('nis_siswa', auth()->user()->id)->get()];
                return view('dashboard.pengajuan.siswa.index', $data);
            case 'walas':
                $data = ['data' => PengajuanSiswa::with('pengajuan', 'siswa')->where('nip_walas', auth()->user()->id)->get()];
                return view('dashboard.pengajuan.walas.index', $data);
        }
    }
    public function tambahPengajuan()
    {
        $data = [
            'siswa' => Siswa::query()->where('id_kelas', auth()->user()->siswa->id_kelas)->get(),
        ];

        return view('dashboard.pengajuan.siswa.tambah', $data);
    }
    public function semuaPengajuan()
    {
        $data = [
            'data' => PengajuanSiswa::with([
                'siswa',
                'pengajuan' => function ($q) {
                    $q->orderBy('created_at', 'desc');
                }
            ])->get(),
        ];
        return view('dashboard.pengajuan.hubin.semuaPengajuan', $data);
    }
    public function pengajuanPending()
    {
        $allowedStatus = ['belum_disetujui', 'disetujui', 'diajukan'];
        $data          = [
            'data' => PengajuanSiswa::with([
                'siswa',
                'pengajuan' => function ($q) use ($allowedStatus) {
                    $q->whereIn('status', $allowedStatus)->orderBy('created_at', 'desc');
                }
            ])->get(),
        ];
        return view('dashboard.pengajuan.hubin.pengajuanPending', $data);
    }
    public function pengajuanDiterima()
    {
        $data = [
            'data' => PengajuanSiswa::with([
                'siswa',
                'pengajuan' => function ($q) {
                    $q->where('status', 'diterima')->orderBy('created_at', 'desc');
                }
            ]),
        ];

        return view('dashboard.pengajuan.hubin.pengajuanDiterima', $data);
    }
    public function pengajuanDitolak()
    {
        $data = [
            'data' => PengajuanSiswa::with([
                'siswa',
                'pengajuan' => function ($q) {
                    $q->where('status', 'ditolak')->orderBy('created_at', 'desc');
                }
            ]),
        ];

        return view('dashboard.pengajuan.hubin.pengajuanDitolak', $data);
    }
    public function prakerin()
    {
        $userRole = auth()->user()->role;

        switch ($userRole)
        {
            case 'hubin':
                $data = [
                    'data'                => Prakerin::query()
                        ->with(['siswa', 'pembimbing_sekolah', 'pengajuan'])
                        ->orderByDesc('tanggal_mulai')
                        ->limit(10)
                        ->get(),
                    'all_prakerin'        => Prakerin::all()->count(),
                    'prakerinBerlangsung' => Prakerin::where('status', 'berlangsung')->count(),
                    'prakerinSelesai'     => Prakerin::where('status', 'selesai')->count(),
                ];

                return view('dashboard.prakerin.hubin.index', $data);
            case 'siswa':
                $data = [
                    'data' => Prakerin::with('siswa')->where('nis', auth()->user()->id)->get(),
                ];
                return view('dashboard.prakerin.siswa.index', $data);
            case 'walas':
                $data = [
                    'data' => Prakerin::with('siswa')->where('nip_walas', auth()->user()->id)->get(),
                ];
                return view('dashboard.prakerin.walas.index', $data);
        }

    }
}