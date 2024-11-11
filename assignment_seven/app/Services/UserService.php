<?php
namespace App\Services;

use DB;
use Hash;

class UserService
{
    public function store($data){
        return DB::transaction(function () use ($data) {
            $user = DB::table('users')->insert([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'created_at' => now()
            ]);
            return $user;
        }, 5);
    }

    public function update($userId, $data){
        return DB::transaction(function () use ($userId, $data) {
            $user = DB::table('users')
                        ->where('id', $userId)
                        ->update([
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'email' => $data['email'],
                            'updated_at' => now()
                        ]);
            return $user;
        }, 5);
    }
}
