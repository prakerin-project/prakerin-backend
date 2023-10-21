<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserLoginRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('index');
    }
    public function index()
    {
        return view('login');
    }
    /** */
    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return Auth::user();
        }

        return response()->json([
            'errors' => [
                'message' => 'Username or password wrong !'
            ]
        ], 401);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}