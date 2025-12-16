<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function dashboard() {
    $userId = Auth::id();
    
    // 1. Ambil DOMPET AKTIF milik USER SENDIRI
    $wallets = Wallet::where('user_id', $userId)->where('is_active', true)->get();

    // Variable Total Gabungan Saldo Awal
    $totalSaldoAwal = 0;
    
    // Looping untuk hitung per dompet
    foreach($wallets as $w) {
        $masuk = Transaction::where('user_id', $userId)->where('wallet_id', $w->id)->where('type', 'income')->sum('amount');
        $keluar = Transaction::where('user_id', $userId)->where('wallet_id', $w->id)->where('type', 'expense')->sum('amount');
        
        // Rumus Per Dompet
        $w->saldo = $w->initial_balance + $masuk - $keluar;
        
        // Tambahkan ke total global
        $totalSaldoAwal += $w->initial_balance;
    }

    // --- PERBAIKAN DI SINI ---
    // Gunakan nama variabel '$pemasukan' dan '$pengeluaran' (Bukan $total...)
    // Agar cocok dengan perintah compact di bawah.
    
    $pemasukan = Transaction::where('user_id', $userId)->where('type', 'income')->sum('amount');
    $pengeluaran = Transaction::where('user_id', $userId)->where('type', 'expense')->sum('amount');
    
    // Rumus Saldo Total = Saldo Awal + Pemasukan - Pengeluaran
    $saldo = $totalSaldoAwal + $pemasukan - $pengeluaran;

    $recent = Transaction::where('user_id', $userId)->latest('date')->take(5)->with(['category', 'wallet'])->get();

    // Sekarang variabel $pemasukan dan $pengeluaran sudah ada, jadi compact tidak akan error lagi.
    return view('dashboard', compact('pemasukan', 'pengeluaran', 'saldo', 'recent', 'wallets'));
}

    public function index($type) {
        $transactions = Transaction::where('user_id', Auth::id())->where('type', $type)->with(['category', 'wallet'])->latest('date')->get();
        
        $categories = Category::where('type', $type)->where(function($q) {
            $q->where('user_id', Auth::id())->orWhereNull('user_id');
        })->get();
        
        $wallets = Wallet::where('user_id', Auth::id())->where('is_active', true)->get();

        return view('transactions.index', compact('transactions', 'type', 'categories', 'wallets'));
    }

    public function store(Request $request) {
        Transaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'name' => $request->name ?? '-',
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'wallet_id' => $request->wallet_id,
        ]);
        return back()->with('success', 'Disimpan!');
    }

    public function edit($id) {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::where('type', $transaction->type)->where(function($q) {
            $q->where('user_id', Auth::id())->orWhereNull('user_id');
        })->get();
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('transactions.edit', compact('transaction', 'categories', 'wallets'));
    }

    public function update(Request $request, $id) {
        Transaction::where('user_id', Auth::id())->findOrFail($id)->update($request->all());
        return redirect()->route($request->type == 'income' ? 'pemasukan' : 'pengeluaran');
    }

    public function destroy($id) {
        Transaction::where('user_id', Auth::id())->findOrFail($id)->delete();
        return back();
    }

    public function laporan(Request $request)
    {
        // 1. Query Dasar & Filter
        $query = Transaction::where('user_id', Auth::id());

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // 2. Ambil Data Transaksi
        $transactions = (clone $query)->with(['category', 'wallet'])->orderBy('date', 'desc')->get();

        // 3. Hitung Total Global
        $totalPemasukan = (clone $query)->where('type', 'income')->sum('amount');
        $totalPengeluaran = (clone $query)->where('type', 'expense')->sum('amount');

        // --- LOGIKA BARU UNTUK GRAFIK KATEGORI ---
        
        // Kelompokkan Pemasukan berdasarkan Nama Kategori
        $incomePie = $transactions->where('type', 'income')->groupBy(function($item) {
            return $item->category->name ?? 'Tanpa Kategori';
        })->map->sum('amount');

        // Kelompokkan Pengeluaran berdasarkan Nama Kategori
        $expensePie = $transactions->where('type', 'expense')->groupBy(function($item) {
            return $item->category->name ?? 'Tanpa Kategori';
        })->map->sum('amount');

        return view('report', compact(
            'transactions', 
            'totalPemasukan', 
            'totalPengeluaran',
            'incomePie',  // Kirim data grafik pemasukan
            'expensePie'  // Kirim data grafik pengeluaran
        ));
    }
}