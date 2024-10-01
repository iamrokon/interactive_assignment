<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/experiences', [ExperienceController::class, 'index'])->name('experiences');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/project-detail/{id}', [ProjectController::class, 'show']);
