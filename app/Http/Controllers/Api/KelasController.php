<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kelas\CreateKelasRequest;
use App\Http\Requests\Kelas\UpdateKelasRequest;
use App\Models\Kelas;
use App\Traits\RequestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    use RequestTrait;

    public function getAll(Request $request): JsonResponse
    {
        $relation = $this->getRelation($request->input('relation', []), ['jurusan', 'walas']);

        $kelas = Kelas::query()->with($relation)->get();

        return response()->json($kelas, 200);
    }

    public function getById(int $id, $relation = [])
    {
        $relation = $this->getRelation($relation, ['jurusan', 'walas']);

        $kelas = Kelas::with($relation)->findOrFail($id);

        return $kelas;
    }

    public function getOne(int $id, Request $request): JsonResponse
    {
        $kelas = $this->getById($id, $request->input('relation', []));

        return response()->json($kelas, 200);
    }

    public function create(CreateKelasRequest $request): JsonResponse
    {
        $data = $request->validated();

        $kelas = Kelas::query()->create($data);

        return response()->json($kelas, 201);
    }

    public function update(int $id, UpdateKelasRequest $request): JsonResponse
    {
        $data = $request->validated();

        $kelas = $this->getById($id);
        $kelas->fill($data)->save();

        return response()->json($kelas, 200);
    }

    public function delete(int $id): JsonResponse
    {
        $kelas = $this->getById($id);
        $kelas->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully.'
        ], 200);
    }
}
