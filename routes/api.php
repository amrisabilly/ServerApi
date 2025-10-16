<?php

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\AplikasiCoffe\AuthentikasiController;
use App\Http\Controllers\Api\AplikasiCoffe\CategoriesController;
use App\Http\Controllers\Api\AplikasiCoffe\ProductController;


// Route API
Route::resource('/person', PersonController::class);

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthentikasiController::class, 'register']);
    Route::post('/login', [AuthentikasiController::class, 'login']);
    Route::get('/users', [AuthentikasiController::class, 'index']);
});

Route::prefix('coffe')->group(function () {
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('products', ProductController::class);
});
