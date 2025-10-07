<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\BerandaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MahasiswaController;



Route::Resource('/mahasiswa', MahasiswaController::class);

Route::get('/', function () {
    return view('landing.home.index');
})->name('index');

Route::get('/about', function () {
    return view('landing.about.index');
})->name('about');

// Route::get('/article', function () {
//     return view('landing.article.index');
// })->name('article');

Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');

// Tambahkan route untuk komentar
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/comments/reply', [\App\Http\Controllers\CommentController::class, 'reply'])->name('comments.reply');
