<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        if(auth()->attempt($credentials)){
            return redirect()->intended(route('profile'));
        }
        return redirect()->route('login');
    }
}
