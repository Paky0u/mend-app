<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WalletController;
// ... (use lain biarkan)

// Di dalam middleware auth:
Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');

// Dompet
Route::get('/dompet', [WalletController::class, 'index'])->name('wallet.index');
Route::post('/dompet', [WalletController::class, 'store'])->name('wallet.store');
Route::delete('/dompet/{id}', [WalletController::class, 'destroy'])->name('wallet.destroy');
Route::get('/dompet/{id}/edit', [WalletController::class, 'edit'])->name('wallet.edit');
Route::put('/dompet/{id}', [WalletController::class, 'update'])->name('wallet.update');

// Kategori
Route::get('/kategori', [CategoryController::class, 'index'])->name('category.index');
Route::post('/kategori', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/kategori/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('category.update');

// Transaksi (Masuk, Keluar, Edit, Hapus)
Route::get('/pemasukan', [TransactionController::class, 'index'])->defaults('type', 'income')->name('pemasukan');
Route::get('/pengeluaran', [TransactionController::class, 'index'])->defaults('type', 'expense')->name('pengeluaran');
Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaksi/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
Route::put('/transaksi/{id}', [TransactionController::class, 'update'])->name('transaction.update');
Route::delete('/transaksi/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

// Laporan
Route::get('/laporan', [TransactionController::class, 'laporan'])->name('laporan');
require __DIR__.'/auth.php';