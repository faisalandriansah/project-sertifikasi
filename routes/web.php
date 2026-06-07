<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;

// Route::get('/', function () {
//     return view('welcome');
// });

// redirect root ke dashboard
Route::redirect('/', '/dashboard');

// dashboard (halaman utama)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// manajemen barang
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/tambah', [BarangController::class, 'create'])->name('create');
    Route::post('/tambah', [BarangController::class, 'store'])->name('store');
    Route::get('/{barang}', [BarangController::class, 'show'])->name('show');
    Route::get('/{barang}/edit', [BarangController::class, 'edit'])->name('edit');
    Route::put('/{barang}', [BarangController::class, 'update'])->name('update');
    Route::delete('/{barang}', [BarangController::class, 'destroy'])->name('destroy');
});

//manajemen kategori
Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::get('/tambah', [KategoriController::class, 'create'])->name('create');
    Route::post('/tambah', [KategoriController::class, 'store'])->name('store');
    Route::get('/{kategori}/edit', [KategoriController::class, 'edit'])->name('edit');
    Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
    Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('destroy');
});

//halaman bantuan
Route::get('/bantuan', fn() => view('bantuan.index'))->name('bantuan');
