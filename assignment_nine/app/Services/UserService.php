<?php
namespace App\Services;

use App\Models\User;
use DB;
use Hash;

class UserService
{
    public function store($data){
        return DB::transaction(function () use ($data) {
            $data = array_merge($data, [
                'password' => Hash::make($data['password']),
                'created_at' => now()
            ]);
            $user = User::create($data);
            return $user;
        }, 5);
    }

    public function update($user, $data, $image = null){
        return DB::transaction(function () use ($user, $data, $image) {
            $data = array_merge($data, [
                'updated_at' => now()
            ]);
            $user->update($data);

            if ($image) {
                $user->clearMediaCollection('avatar');
                $user->addMedia($image)
                    ->toMediaCollection('avatar');
            }
            return $user;
        }, 5);
    }
}
