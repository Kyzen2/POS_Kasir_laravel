<?php

use App\Http\Controllers\ExportAbsensiController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportController;
use App\Livewire\Absen;
use App\Livewire\Asset;
use App\Livewire\Evaluasi;
use App\Livewire\Pengguna;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/pengguna', Pengguna::class)->middleware(['auth'])->name('pengguna');
Route::get('/absen', Absen::class)->middleware(['auth'])->name('absen');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/evaluasi', Evaluasi::class)->middleware(['auth'])->name('evaluasi');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
Route::get('/asset', Asset::class)->middleware(['auth'])->name('asset');

// Menambahkan route untuk ekspor PDF
Route::get('/export-pdf', [ExportController::class, 'exportPdf'])->middleware(['auth'])->name('export-pdf');
Route::get('/absensi/export/pdf', [ExportAbsensiController::class, 'exportPDF'])->name('absensi.export.pdf');

// Route cetak untuk laporan
Route::get('/cetak', [HomeController::class, 'cetak'])->name('cetak');
