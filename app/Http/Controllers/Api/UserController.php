<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\Hubin;
use App\Models\Kaprog;
use App\Models\Pembimbing;
use App\Models\Siswa;
use App\Models\TataUsaha;
use App\Models\User;
use App\Models\Walas;
use App\Traits\RequestTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use RequestTrait;
    private Model $Model;
    /**
     * Initialize class Model by role
     */
    private function useModel($role)
    {
        if ($role === 'tu')
            $this->Model = new TataUsaha;
        if ($role === 'siswa')
            $this->Model = new Siswa;
        if ($role === 'kaprog')
            $this->Model = new Kaprog;
        if ($role === 'pb_sekolah' || $role === 'pb_industri')
            $this->Model = new Pembimbing;
        if ($role === 'walas')
            $this->Model = new Walas;
        if ($role === 'hubin')
            $this->Model = new Hubin;
    }
    /**
     * Create intended role after create user
     */
    private function createRole($id, CreateUserRequest $request)
    {
        return $this->Model::query()->create(
            $request
                ->merge(['id_user' => $id])
                ->except(['username', 'password', 'role'])
        )->with('user')->get(['*']);
    }
    /**
     * Get all records from User
     */
    public function getAll(Request $request)
    {
        $relations = $this->getRelation($request->relation, $request->relation);
        foreach ($relations as $relation) {
            $users[$relation] = User::query()->has($relation)->with($relation)->get();
        }
        return response()->json($users, 200);
    }
    /**
     * Get specified user by role
     */
    public function getOne(Request $request)
    {
        $user = User::query()->has($request->role)->whereKey($request->id)->with($request->role)->firstOrFail();
        return response()->json($user, 200);
    }
    /**
     * Create User
     */
    public function create(CreateUserRequest $request)
    {
        $this->useModel($request->role);
        $user = User::query()->create(
            $request->merge(['role' => $request->role])->only(['role', 'username', 'password'])
        );

        $resp = $this->createRole($user->id, $request);

        return response()->json($resp);
    }
    /**
     * Update User Records with role
     */
    public function update(CreateUserRequest $request)
    {
        return response()->json([$request->all(), $request->role]);
    }
    /**
     * Delete records from database
     */
    public function delete(CreateUserRequest $request)
    {
        return response()->json([$request->all(), $request->role]);
    }
}