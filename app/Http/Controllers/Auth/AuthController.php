<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Logs in a user.
     *
     * @param Request $request The request object containing the user's credentials.
     * @return JsonResponse The JSON response containing the status and token.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20',
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $credentials = $request->only('username', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'failed',
                'errors' => [
                    'message' => [
                        "Username or password doesn't match."
                    ]
                ]
            ], 401);
        }

        $user = User::where('username', $request['username'])->first();
        $token = $user->createToken('access_token')->plainTextToken;
        $user->token = $token;
        $user->save();

        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 200);
    }

    /**
     * Retrieves the user information.
     *
     * @return JsonResponse The JSON response containing the user information.
     */
    public function getUser(): JsonResponse
    {
        $user = Auth::user();
        return response()->json($user, 200);
    }

    /**
     * Logout the user.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the user is not found.
     * @return \Illuminate\Http\JsonResponse The JSON response with the status 'success'.
     */
    public function logout()
    {
        $userId = Auth::id();
        User::findOrFail($userId)->update(['token' => null]);
        return response()->json(['status' => 'success'], 200);
    }
}
