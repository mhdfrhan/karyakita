<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/semua-produk', 'semuaProduk')->name('semua-produk');
    Route::get('/semua-jasa', 'semuaJasa')->name('semua-jasa');
    Route::get('/faq', 'faq')->name('faq');

    // produk
    Route::get('/produk/{slug}', 'detailProduk')->name('detailProduk');
    Route::get('/kategori/{slug}', 'detailKategori')->name('detailKategori');
    Route::get('/kategori/{slug}/{slug2}', 'detailSubKategori')->name('detailSubKategori');

    // toko
    Route::get('/daftar-toko', 'daftarToko')->name('daftarToko');

    // user
    Route::get('/toko/{slug}', 'detailToko')->name('detailToko');
});

Route::post('/upload', [UploadController::class, 'uploadFile'])->name('produk.upload');

// dashboard penjual
Route::middleware('penjual')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');

        // informasi saldo
        Route::get('/dashboard/mutasi-saldo', 'mutasiSaldo')->name('mutasiSaldo');
        Route::get('/dashboard/penarikan-saldo', 'penarikanSaldo')->name('penarikanSaldo');
    });

    Route::controller(ProductsController::class)->group(function () {
        // produk
        Route::get('/dashboard/produk', 'produk')->name('dashboard.produk');
        Route::get('/dashboard/produk/tambah', 'tambahProduk')->name('tambahProduk');
        Route::get('/dashboard/produk/edit/{slug}', 'editProduk')->name('editProduk');
        Route::get('/dashboard/produk/{slug}/bayar', 'bayar')->name('bayarProduk');
    });

    Route::controller(ServicesController::class)->group(function () {
        // jasa
        Route::get('/dashboard/jasa', 'jasa')->name('dashboard.jasa');
        Route::get('/dashboard/jasa/tambah', 'tambahJasa')->name('tambahJasa');
        Route::get('/dashboard/jasa/edit/{slug}', 'editJasa')->name('editJasa');
        Route::get('/dashboard/jasa/{slug}/bayar', 'bayar')->name('bayarJasa');
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
