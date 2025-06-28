<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BpenjualanController;
use App\Http\Controllers\JpenjualanController;
use App\Http\Controllers\MpenjualanController;
use App\Http\Controllers\TpenjualanController;
use App\Http\Controllers\PerbandinganpenjualanController;

Route::middleware(['auth', 'role:superadmin,user,staff', 'check.permission'])->group(function () {
    // Menu Penjualan (Utama)
    Route::resource('/master-penjualan', MpenjualanController::class)->except(['show']);
    Route::resource('/barang-penjualan', BpenjualanController::class)->except(['show']);
    Route::resource('/jenis-penjualan', JpenjualanController::class)->except(['show']);
    Route::resource('/transaksi-penjualan', TpenjualanController::class)->except(['show']);
    Route::resource('/perbandingan-penjualan', PerbandinganpenjualanController::class)->except(['show']);

    Route::get('/transaksi-penjualan/reset', [TpenjualanController::class, 'reset'])->name('transaksi-penjualan.reset');
    // Menu Penjualan (Utama)
});