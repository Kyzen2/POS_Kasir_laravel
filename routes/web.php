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
Route::get('/pengguna', User::class)->middleware(['auth'])->name('pengguna');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');

// Menambahkan route untuk ekspor PDF
Route::get('/export-pdf', [ExportController::class, 'exportPdf'])->middleware(['auth'])->name('export-pdf');

// Route cetak untuk laporan
Route::get('/cetak', [HomeController::class, 'cetak'])->name('cetak');
