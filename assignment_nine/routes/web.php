<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/posts-single/{post}', [HomeController::class, 'show'])->name('posts-single');
Route::middleware('auth')->group(function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile-edit/{user}', [ProfileController::class, 'edit'])->name('profile-edit');
    Route::patch('/profile-update/{user}', [ProfileController::class, 'update'])->name('profile-update');
    Route::resource('/posts', PostController::class);
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
