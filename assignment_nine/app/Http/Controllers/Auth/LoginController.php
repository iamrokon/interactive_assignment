<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        if(auth()->attempt($credentials)){
            return redirect()->intended(default: route('home'));
        }
        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout(); // Log out the user
        request()->session()->invalidate(); // Invalidate the session
        request()->session()->regenerateToken(); // Regenerate CSRF token for security

        return redirect('/'); // Redirect to a desired page (e.g., homepage)
    }
}
