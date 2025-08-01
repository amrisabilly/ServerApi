<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;

Route::get('/', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.detail');
