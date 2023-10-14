<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisPerusahaan\JenisPerusahaanRequest;
use App\Models\JenisPerusahaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisPerusahaanController extends Controller
{
    public function getALl(): JsonResponse
    {
        $j_perusahaan = JenisPerusahaan::query()->with('perusahaan')->orderBy('nama')->get();

        return response()->json($j_perusahaan, 200);
    }

    public function getById(int $id)
    {
        $j_perusahaan = JenisPerusahaan::with('perusahaan')->findOrFail($id);

        return $j_perusahaan;
    }

    public function getOne(int $id): JsonResponse
    {
        $j_perusahaan = $this->getById($id);

        return response()->json($j_perusahaan, 200);
    }

    public function create(JenisPerusahaanRequest $request)
    {
        $data = $request->validated();

        $j_perusahaan = JenisPerusahaan::query()->create($data);

        return response()->json($j_perusahaan, 201);
    }

    public function update(int $id, JenisPerusahaanRequest $request)
    {
        $data = $request->validated();
        $j_perusahaan = $this->getById($id);

        $j_perusahaan->fill($data)->save();

        return $j_perusahaan;
    }

    public function delete(int $id)
    {
        $this->getById($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ], 200);
    }
}
