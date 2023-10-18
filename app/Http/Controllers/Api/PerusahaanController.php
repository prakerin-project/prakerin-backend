<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perusahaan\CreatePerusahaanRequest;
use App\Http\Requests\Perusahaan\UpdatePerusahaanRequest;
use App\Models\JenisPerusahaan;
use App\Models\Perusahaan;
use App\Traits\FotoTrait;
use Illuminate\Http\JsonResponse;

class PerusahaanController extends Controller
{
    use FotoTrait;

    public function index()
    {
        $data = [
            'perusahaan' => $this->getAll(),
            'jenis_perusahaan' => JenisPerusahaan::all()
        ];

        return view('dashboard.perusahaan.index', $data);
    }

    public function detail(int $id)
    {
        $data = [
            'perusahaan' => $this->getById($id),
        ];

        return view('dashboard.perusahaan.detail', $data);
    }

    public function getAll()
    {
        $data = Perusahaan::with('jenis_perusahaan', 'foto')->orderBy('nama_perusahaan')->get();
        return $data;
    }

    public function getById(int $id)
    {
        $perusahaan = Perusahaan::query()->with('jenis_perusahaan', 'foto')->findOrFail($id);

        return $perusahaan;
    }

    public function getOne(int $id)
    {
        $perusahaan = $this->getById($id);

        return response()->json($perusahaan, 200);
    }

    public function create(CreatePerusahaanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $perusahaan = Perusahaan::query()->create($data);

        if ($request->hasFile('foto')) {
            foreach ($request->foto as $foto) {
                $this->uploadFoto($perusahaan->id, $foto);
            }
        }

        return response()->json($perusahaan, 201);
    }

    public function update(int $id, UpdatePerusahaanRequest $request): JsonResponse
    {
        $data = $request->validated();
        $perusahaan = $this->getById($id);

        $perusahaan->fill($data)->save();

        return response()->json($perusahaan, 200);
    }

    public function delete(int $id)
    {
        // Search perusahaan
        $perusahaan = $this->getById($id);

        if ($perusahaan->foto->count() > 0) {
            // Deleting each foto of perusahaan
            foreach ($perusahaan->foto as $foto) {
                $this->deleteFoto($foto->id);
            }
        }

        // Deleting perusahaan
        $perusahaan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully.'
        ]);
    }
}
