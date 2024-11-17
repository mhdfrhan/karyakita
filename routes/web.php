<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/semua-produk', 'semuaProduk')->name('semua-produk');
    Route::get('/semua-jasa', 'semuaJasa')->name('semua-jasa');
    Route::get('/faq', 'faq')->name('faq');

    // toko
    Route::get('/daftar-toko', 'daftarToko')->name('daftarToko');
});

// dashboard penjual
Route::middleware('penjual')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/produk', 'produk')->name('dashboard.produk');
        Route::get('/dashboard/produk/tambah', 'tambahProduk')->name('tambahProduk');
    });
});

// route phpinfo
Route::get('/phpinfo', function () {
    phpinfo();
}); 

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
