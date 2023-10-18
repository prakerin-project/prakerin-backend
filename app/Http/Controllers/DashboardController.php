<?php

namespace App\Http\Controllers;

use App\Models\JenisPerusahaan;
use App\Models\Perusahaan;
use App\Models\User;
use App\Traits\RoleToRelationTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function perusahaan()
    {
        $data = [
            'perusahaan'       => Perusahaan::with('jenis_perusahaan', 'foto')->get(),
            'jenis_perusahaan' => JenisPerusahaan::all()
        ];
        return view('dashboard.perusahaan', $data);
    }

    public function user()
    {
        $data = [
            'users' => User::all()
        ];

        return view('dashboard.user.index', $data);
    }
    public function userDetail(Request $request)
    {
        $relation = $this->roleToRelation($request->role);
        $user = User::with($relation)->has($relation[0])->findOrFail($request->id);

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
}