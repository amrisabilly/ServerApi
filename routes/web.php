<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landing\BerandaController;

Route::get('/', function () {
    return view('landing.home.index');
})->name('index');

Route::get('/about', function () {
    return view('landing.about.index');
})->name('about');
