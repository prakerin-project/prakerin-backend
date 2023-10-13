<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Perusahaan\CreatePerusahaanRequest;
use App\Models\Foto;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerusahaanController extends Controller
{
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
                $fileName = $perusahaan->id . "_" . Str::random(10) . '.' . $foto->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('perusahaan', $foto, $fileName);

                Foto::query()->create([
                    'id_perusahaan' => $perusahaan->id,
                    'path' => $fileName
                ]);
            }
        }

        return response()->json($perusahaan, 201);
    }

    public function deleteFoto(int $id)
    {
        $foto = Foto::query()->findOrFail($id);

        // Delete foto on storage
        Storage::disk("public")->delete("perusahaan/$foto->path");

        // Delete record of foto
        $foto->delete();
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
