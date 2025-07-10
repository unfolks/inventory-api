<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\UserController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('produk', ProdukController::class);
    Route::apiResource('lokasi', LokasiController::class);
    Route::apiResource('mutasi', MutasiController::class);
    Route::apiResource('user', UserController::class);

    Route::get('mutasi/produk/{id}', [MutasiController::class, 'mutasiByProduk']);
    Route::get('mutasi/user/{id}', [MutasiController::class, 'mutasiByUser']);

    Route::post('logout', [AuthController::class, 'logout']);
});
