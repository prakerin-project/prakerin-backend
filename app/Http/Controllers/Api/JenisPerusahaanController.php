<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisPerusahaan\JenisPerusahaanRequest;
use App\Models\JenisPerusahaan;
use App\Traits\RequestTrait;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class JenisPerusahaanController extends Controller
{
    use RequestTrait;

    public function getALl(Request $request): JsonResponse
    {
        $relation = $this->getRelation($request->input('relation', []), ['perusahaan']);

        $j_perusahaan = JenisPerusahaan::query()->with($relation)->orderBy('nama')->get();

        return response()->json($j_perusahaan, 200);
    }

    public function getById(int $id, $relation = [])
    {
        $relation = $this->getRelation($relation, ['perusahaan']);

        $j_perusahaan = JenisPerusahaan::with($relation)->findOrFail($id);

        return $j_perusahaan;
    }

    public function getOne(int $id, Request $request): JsonResponse
    {
        $j_perusahaan = $this->getById($id, $request->input('relation', []));

        return response()->json($j_perusahaan, 200);
    }

    public function create(JenisPerusahaanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $j_perusahaan = JenisPerusahaan::query()->create($data);

        return response()->json($j_perusahaan, 201);
    }

    public function update(int $id, JenisPerusahaanRequest $request): JsonResponse
    {
        $data = $request->validated();
        $j_perusahaan = $this->getById($id);

        $j_perusahaan->fill($data)->save();

        return response()->json($j_perusahaan, 200);
    }

    public function delete(int $id): JsonResponse
    {
        $this->getById($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ], 200);
    }
}
