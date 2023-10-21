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

    /**
     * Get all Data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $relation = $this->getRelation($request->input('relation', []), ['kelas', 'kaprog', 'pembimbing']);

        $jurusan = Jurusan::query()->with($relation)->get();

        return response()->json($jurusan, 200);
    }

    /**
     * Get one data by ID
     *
     * @param integer $id
     * @param array $relation
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|array

     */
    public function getById(int $id, $relation = [])
    {
        $relation = $this->getRelation($relation, ['kelas', 'kaprog', 'pembimbing']);

        $jurusan = Jurusan::with($relation)->findOrFail($id);

        return $jurusan;
    }

    /**
     * GetOne
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function getOne(int $id, Request $request): JsonResponse
    {
        $jurusan = $this->getById($id, $request->input('relation', []));

        return response()->json($jurusan, 200);
    }

    /**
     * Create new record
     *
     * @param CreateJurusanRequest $request
     * @return JsonResponse
     */
    public function create(CreateJurusanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = Jurusan::query()->create($data);

        return response()->json($jurusan, 201);
    }

    /**
     * Update existing record
     *
     * @param integer $id
     * @param UpdateJurusanRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateJurusanRequest $request): JsonResponse
    {
        $data = $request->validated();

        $jurusan = $this->getById($id);

        $jurusan->fill($data)->save();

        return response()->json($jurusan, 200);
    }

    /**
     * Delete record from database
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $jurusan = $this->getById($id);
        $jurusan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Deleted successfully.'
        ], 200);
    }
}
