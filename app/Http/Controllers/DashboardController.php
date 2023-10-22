<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\PerusahaanController;
use App\Models\JenisPerusahaan;
use App\Models\Logs;
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

    public function log()
    {
        $data = [
            'logs' => Logs::orderBy('created_at')->get()
        ];

        return view('dashboard.log', $data);
    }
}
