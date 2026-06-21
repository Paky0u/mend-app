<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileController;

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
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
    Route::get('/laporan/export', [TransactionController::class, 'export'])->name('laporan.export');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Premium
    Route::get('/premium', [App\Http\Controllers\PremiumController::class, 'index'])->name('premium.index');
    Route::post('/premium/checkout', [App\Http\Controllers\PremiumController::class, 'checkout'])->name('premium.checkout');
    Route::post('/premium/cancel', [App\Http\Controllers\PremiumController::class, 'cancel'])->name('premium.cancel');
    Route::post('/premium/success', [App\Http\Controllers\PremiumController::class, 'success'])->name('premium.success');
});

// Midtrans Webhook Callback
Route::post('/midtrans/callback', [App\Http\Controllers\PremiumController::class, 'callback']);

require __DIR__.'/auth.php';