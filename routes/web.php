<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;

Route::get('/', [ArtikelController::class, 'index']);
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show');