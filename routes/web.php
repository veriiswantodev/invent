<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
    AuthController,
    DashboardController,
    BarangController,
    TempatController,
    KategoriController,
    SettingController
};

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/barang/data', [BarangController::class, 'data'])->name('barang.data');
Route::post('/barang/cetak-barcode', [BarangController::class, 'cetakBarcode'])->name('barang.cetak_barcode');
Route::get('/barang/pdf/{id}', [BarangController::class, 'pdf'])->name('barang.pdf');
Route::resource('/barang', BarangController::class);

Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
Route::resource('/kategori', KategoriController::class);

Route::get('/tempat/data', [TempatController::class, 'data'])->name('tempat.data');
Route::get('/tempat/{id}', [TempatController::class, 'pdf'])->name('tempat.pdf');
Route::resource('/tempat', TempatController::class);

Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
Route::get('/setting/first', [SettingController::class, 'show'])->name('setting.show');
Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
