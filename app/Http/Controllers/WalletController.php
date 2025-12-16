<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // [WAJIB] Biar bisa ambil ID user login

class WalletController extends Controller
{
    // Tampilkan Daftar Dompet (Hanya milik user login)
    public function index() {
        // [UBAH] Dari all() menjadi where user_id
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('wallets.index', compact('wallets'));
    }

    // Simpan Dompet Baru
    public function store(Request $request) {
        // [TAMBAH] Validasi agar saldo awal harus angka
        $request->validate([
            'name' => 'required|string|max:255',
            'initial_balance' => 'required|numeric' 
        ]);

        Wallet::create([
            'user_id' => Auth::id(), // [BARU] Set pemilik dompet
            'name' => $request->name,
            'initial_balance' => $request->initial_balance, // [BARU] Simpan saldo awal
            'is_active' => $request->has('is_active')
        ]);
        
        return back()->with('success', 'Dompet berhasil ditambahkan!');
    }

    // Hapus Dompet (Aman)
    public function destroy($id) {
        // [UBAH] Pastikan cuma bisa hapus punya sendiri
        Wallet::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back()->with('success', 'Dihapus!');
    }

    // Halaman Edit Dompet (Aman)
    public function edit($id)
    {
        // [UBAH] Cek kepemilikan
        $wallet = Wallet::where('user_id', Auth::id())->findOrFail($id);
        return view('wallets.edit', compact('wallet'));
    }

    // Proses Update Dompet
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'initial_balance' => 'required|numeric' // [BARU] Validasi saldo
        ]);

        // [UBAH] Cek kepemilikan sebelum update
        $wallet = Wallet::where('user_id', Auth::id())->findOrFail($id);
        
        $wallet->update([
            'name' => $request->name,
            'initial_balance' => $request->initial_balance, // [BARU] Update saldo awal
            'is_active' => $request->has('is_active') ? true : false
        ]);

        return redirect()->route('wallet.index')->with('success', 'Dompet berhasil diupdate!');
    }
}