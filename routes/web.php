<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
<<<<<<< HEAD

// Menambahkan route untuk ekspor PDF
Route::get('/export-pdf', [ExportController::class, 'exportPdf'])->middleware(['auth'])->name('export-pdf');

// Route cetak untuk laporan
Route::get('/cetak', [HomeController::class, 'cetak'])->name('cetak');
=======
Route::get('/cetak', ['App\Http\Controllers\HomeController', 'cetak'])->name('cetak');



>>>>>>> 375d059abcd73a8845e4fd956c4d705122e9bdb1
