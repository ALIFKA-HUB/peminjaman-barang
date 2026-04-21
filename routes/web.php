<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/table', [ItemController::class, 'index'])->name('table.index');
Route::post('/table/store', [ItemController::class, 'store'])->name('items.store');
Route::put('/table/update/{id}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/table/delete/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::get('/form', [ItemController::class, 'manage'])->name('form.index');
Route::post('/simpan-peminjaman', [PeminjamanController::class, 'store'])->name('form.store');

Route::get('/history', [PeminjamanController::class, 'index'])->name('history.index');
Route::post('/peminjaman/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembali');
Route::post('/peminjaman/bermasalah/{id}', [PeminjamanController::class, 'bermasalah'])->name('peminjaman.bermasalah');

// Halaman Barang Rusak/Hilang
Route::get('/barang-rusak', [PeminjamanController::class, 'halamanRusak'])->name('peminjaman.rusak');

// Halaman Khusus Sanksi/Denda
Route::get('/daftar-sanksi', [PeminjamanController::class, 'halamanSanksi'])->name('peminjaman.sanksi');
