<?php
namespace App\Http\Controllers;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index() {
        $wallets = Wallet::all();
        return view('wallets.index', compact('wallets'));
    }

    public function store(Request $request) {
        Wallet::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active')
        ]);
        return back()->with('success', 'Berhasil!');
    }

    public function destroy($id) {
        Wallet::findOrFail($id)->delete();
        return back()->with('success', 'Dihapus!');
    }
    // Halaman Edit Dompet
    public function edit($id)
    {
        $wallet = Wallet::findOrFail($id);
        return view('wallets.edit', compact('wallet'));
    }

    // Proses Update Dompet
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $wallet = Wallet::findOrFail($id);
        
        $wallet->update([
            'name' => $request->name,
            // Cek checkbox aktif/tidak
            'is_active' => $request->has('is_active') ? true : false
        ]);

        return redirect()->route('wallet.index')->with('success', 'Dompet berhasil diupdate!');
    }
}