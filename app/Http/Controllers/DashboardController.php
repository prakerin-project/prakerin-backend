<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\PerusahaanController;
use App\Models\JenisPerusahaan;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
            'perusahaan' => Perusahaan::with('jenis_perusahaan', 'foto')->get(),
            'jenis_perusahaan' => JenisPerusahaan::all()
        ];
        return view('dashboard.perusahaan', $data);
    }

    public function user()
    {
        $data = [
            'users' => User::all()
        ];

        return view('dashboard.user', $data);
    }
}
