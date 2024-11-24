<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(RegisterRequest $request, UserService $userService) {
        $user = $userService->store($request->validated());
        if($user){
            return redirect()->route('login')->with([
                'msg' => 'User created successfully'
            ]);
        }
        return redirect()->route('register');
    }
}
