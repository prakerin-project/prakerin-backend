<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return view('login');
        }

        return redirect()->to('/dashboard');
    }
    
    public function login()
    {
        
    }
    public function logout()
    {
        
    }
}
