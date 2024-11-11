<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    public function edit(User $user) {
        return view('profile.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, $id, UserService $userService) {
        $user = $userService->update($id, $request->validated());
        if($user) {
            return redirect()->route('profile')->with([
                'msg' => 'Profile updated successfully'
            ]);
        }
        return redirect()->back();
    }
}
