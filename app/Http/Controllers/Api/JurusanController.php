<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Jurusan\CreateJurusanRequest;
use App\Http\Requests\Jurusan\UpdateJurusanRequest;
use App\Models\Jurusan;
use App\Traits\RequestTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    use RequestTrait;

    public function getAll(Request $request): JsonResponse
    {
        $relation = $this->getRelation($request->input('relation', []), ['kelas', 'kaprog', 'pembimbing']);

        $jurusan = Jurusan::query()->with($relation)->get();

        return response()->json($jurusan, 200);
    }

    public function getById(int $id, $relation = [])
    {
        $relation = $this->getRelation($relation, ['kelas', 'kaprog', 'pembimbing']);

        $j_perusahaan = Jurusan::with($relation)->findOrFail($id);

        return $j_perusahaan;
    }

    public function getOne(int $id, Request $request): JsonResponse
    {
        $jurusan = $this->getById($id, $request->input('relation', []));

        return response()->json($jurusan, 200);
    }

    public function create(CreateJurusanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = Jurusan::query()->create($data);

        return response()->json($jurusan, 201);
    }

    public function update(int $id, UpdateJurusanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = $this->getById($id);

        $jurusan->fill($data)->save();

        return response()->json($jurusan, 200);
    }

    public function delete(int $id): JsonResponse
    {
        $jurusan = $this->getById($id);
        $jurusan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully.'
        ], 200);
    }
}
