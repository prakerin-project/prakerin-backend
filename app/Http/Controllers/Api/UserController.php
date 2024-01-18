<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadUserPhotoRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Hubin;
use App\Models\Kaprog;
use App\Models\Pembimbing;
use App\Models\Siswa;
use App\Models\TataUsaha;
use App\Models\User;
use App\Models\Walas;
use App\Traits\RequestTrait;
use App\Traits\RoleToRelationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Storage;

class UserController extends Controller
{
    use RequestTrait, RoleToRelationTrait;
    private Model $Model;
    /**
     * Change model to current requested model
     *
     * @param string $role
     * @return void
     */
    private function useModel($role)
    {
        if ($role === 'tu')
            $this->Model = new TataUsaha;
        if ($role === 'siswa')
            $this->Model = new Siswa;
        if ($role === 'kaprog')
            $this->Model = new Kaprog;
        if ($role === 'pembimbing')
            $this->Model = new Pembimbing;
        if ($role === 'walas')
            $this->Model = new Walas;
        if ($role === 'hubin')
            $this->Model = new Hubin;
    }
    /**
     * Retrieves the role model for the given role.
     *
     * @param string $role The role for which to retrieve the model.
     * @return Model The role model.
     */
    public static function getRoleModel(string $role)
    {
        $retVal = (new static);
        $retVal->useModel($role);
        return $retVal->Model;
    }
    public function index()
    {
        $data = [
            'users' => User::all()
        ];

        return view('dashboard.user.index', $data);
    }
    /**
     * Create role after user
     *
     * @param string $id
     * @param CreateUserRequest $request
     * @return static
     */
    private function createRole($id, CreateUserRequest $request)
    {
        return $this->Model::query()->create(
            $request
                ->merge(['id_user' => $id])
                ->except(['username', 'password', 'role'])
        )->load('user');
    }
    private function updateUser($id, UpdateUserRequest $request, string|array $relation = [])
    {
        return User::with($relation)->find($id)->fill($request->only('username', 'password'))->save();
    }
    /**
     * Get all data records from database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $relations = empty($request->relation)
            ? ["hubin", "tata_usaha", "siswa", "pembimbing", "kaprog", "walas"]
            : $this->getRelation($request->relation, $request->relation);

        foreach ($relations as $relation) {
            $users[$relation] = User::query()->has($relation)->with($relation)->get();
        }

        return response()->json($users, 200);
    }
    /**
     * Get one data from database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getOne(Request $request): JsonResponse
    {
        $user = User::query()->has($request->role)->whereKey($request->id)->with($request->role)->firstOrFail();
        return response()->json($user, 200);
    }
    /**
     * Create user
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function create(CreateUserRequest $request): JsonResponse
    {
        //TODO: Change pembimbing to only pembimbing, no p_se.. or pb_in.. upon creation (Check blade!)
        $this->useModel($request->role);
        $user = User::query()->create(
            $request->merge(['role' => $request->role])->only(['role', 'username', 'password'])
        );

        $res = $this->createRole($user->id, $request);

        return response()->json($res);
    }
    /**
     * Update user from request
     *
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $this->useModel($request->role);
        $role        = $this->roleToRelation($request->role)[0];
        $user        = User::with($role)->has($role)->findOrFail($request->id);
        $currRoleKey = $user->getRelation($role)->getKey();
        $roleModel   = $this->Model::query()->findOrFail($currRoleKey);
        $user->fill($request->only(['username', 'password']))->save();
        $roleModel->fill($request->except(['username', 'password']))->save();

        $res[] = $user->getChanges();
        $res[] = $roleModel->getChanges();

        return response()->json($res);
    }
    /**
     * Delete record from databse
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        //TODO: KNOWN UNHANDLED VULNERABILITIES, DELETE IMAGE AMONG USER DELETION
        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json([
            "status"  => "success",
            "message" => "User $user->username deleted."
        ]);
    }
    public function uploadFoto(UploadUserPhotoRequest $request)
    {
        $currDate = Carbon::now(16)->format("Y-m-d");
        $currUser = User::query()->findOrFail($request->id);
        $oldFile  = $currUser->foto_profil;
        if (!empty($oldFile) && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        $file     = $request->file('foto_profil');
        $ext      = $file->getClientOriginalExtension();
        $fileName = $currUser->username . "_" . $currDate . "." . $ext;
        $file->storePubliclyAs("user", $fileName, "public");

        $currUser->foto_profil = $fileName;
        return $currUser->saveOrFail()
            ? response()->json(["foto_profil" => $file->getClientOriginalName()])
            : response()->json(["errors" => ["message" => "Foto profil $currUser->username gagal diupload"]], 422);
    }
}