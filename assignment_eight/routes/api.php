<?php

use App\Http\Controllers\Api\ProductExportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products/export', [ProductExportController::class, 'export']);
