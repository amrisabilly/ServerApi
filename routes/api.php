<?php

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\AplikasiCoffe\AuthentikasiController;
use App\Http\Controllers\Api\AplikasiCoffe\CategoriesController;
use App\Http\Controllers\Api\AplikasiCoffe\FavouriteController;
use App\Http\Controllers\Api\AplikasiCoffe\OrderController;
use App\Http\Controllers\Api\AplikasiCoffe\OrderItemsController;
use App\Http\Controllers\Api\AplikasiCoffe\ProductController;
use App\Http\Controllers\Api\AplikasiCoffe\RatingsController;
use App\Http\Controllers\Api\Bencana\PenggunaController;
use App\Http\Controllers\Api\MbahOerip\CategoryController;
use App\Http\Controllers\Api\MbahOerip\HomeController;
use App\Http\Controllers\Api\MbahOerip\MenuController;

// Route API
Route::resource('/person', PersonController::class);

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthentikasiController::class, 'register']);
    Route::post('/profile/upload-photo', [AuthentikasiController::class, 'uploadPhoto']);
    Route::post('/profile/add-point', [AuthentikasiController::class, 'addPoint']); // <--- contoh tambahan
    Route::post('/profile/redeem-points', [AuthentikasiController::class, 'redeemPoints']); // <--- contoh tambahan
    Route::post('/login', [AuthentikasiController::class, 'login']);
    Route::get('/users', [AuthentikasiController::class, 'index']);
});

Route::prefix('coffe')->group(function () {
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('order-items', OrderItemsController::class);
    Route::apiResource('ratings', RatingsController::class);
    Route::apiResource('favourites', FavouriteController::class); // <--- Jika ada controller favourites
});

Route::prefix('mbah-oerip')->group(function () {

    // mendaftarkan 5 rute CRUD untuk Kategori:
    // GET    /api/mbah-oerip/categories        -> CategoryController@index
    // POST   /api/mbah-oerip/categories        -> CategoryController@store
    // GET    /api/mbah-oerip/categories/{id}   -> CategoryController@show
    // PUT    /api/mbah-oerip/categories/{id}   -> CategoryController@update
    // DELETE /api/mbah-oerip/categories/{id}   -> CategoryController@destroy
    Route::apiResource('categories', CategoryController::class);

    // mendaftarkan 5 rute CRUD untuk Menu:
    // GET    /api/mbah-oerip/menu              -> MenuController@index
    // POST   /api/mbah-oerip/menu              -> MenuController@store
    // GET    /api/mbah-oerip/menu/{id}         -> MenuController@show
    // PUT    /api/mbah-oerip/menu/{id}         -> MenuController@update
    // DELETE /api/mbah-oerip/menu/{id}         -> MenuController@destroy
    Route::apiResource('menu', MenuController::class);
    // Route::get('/best-sellers', [HomeController::class, 'getBestSellers']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Bencana Routes
Route::prefix('bencana')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [PenggunaController::class, 'login']);
    });

    Route::apiResource('pengguna', PenggunaController::class);
});
