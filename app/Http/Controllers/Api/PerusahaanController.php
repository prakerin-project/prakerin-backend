<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perusahaan\CreatePerusahaanRequest;
use App\Models\Foto;
use App\Models\Perusahaan;
use App\Traits\FotoTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerusahaanController extends Controller
{
    use FotoTrait;

    public function getAll(): JsonResponse
    {
        $data = Perusahaan::with('jenis_perusahaan', 'foto')->get();
        return response()->json($data, 200);
    }

    public function getById(int $id)
    {
        $perusahaan = Perusahaan::query()->with('jenis_perusahaan', 'foto')->findOrFail($id);

        return response()->json($perusahaan, 200);
    }

    public function create(CreatePerusahaanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $perusahaan = Perusahaan::query()->create($data);

        if ($request->hasFile('foto')) {
            foreach ($request->foto as $foto) {
                $this->fotoUpload($perusahaan->id, $foto);
            }
        }

        return response()->json($perusahaan, 201);
    }

    public function delete(int $id)
    {
        // Search perusahaan
        $perusahaan = Perusahaan::query()->with('jenis_perusahaan', 'foto')->findOrFail($id);

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
