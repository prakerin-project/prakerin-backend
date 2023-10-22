<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserLoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->only('index');
    }

    public function index()
    {
        return view('login');
    }

    public function profile()
    {
        $data = [
            'user' => Auth::user()
        ];

        return view('dashboard.profile', $data);
    }
    
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
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
