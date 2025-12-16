<x-app-layout>
    <h2 class="page-title">Ringkasan Keuangan</h2>

    <div class="stats-grid">
        <div class="card">
            <div class="card-title">Total Pemasukan</div>
            <div class="card-amount text-green">Rp {{ number_format($pemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-title">Total Pengeluaran</div>
            <div class="card-amount text-red">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-title">Sisa Saldo (Gabungan)</div>
            <div class="card-amount text-blue">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
        </div>
    </div>

    <h3 style="margin-bottom: 15px; font-size: 18px; color: #334155;">Rincian Dompet / Rekening</h3>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
        @foreach($wallets as $wallet)
        <div style="background: white; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; border-left: 4px solid #64748b;">
            <div style="font-size: 12px; color: #64748b; font-weight: bold; margin-bottom: 5px;">{{ $wallet->name }}</div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Rp {{ number_format($wallet->saldo ?? 0, 0, ',', '.') }}
            </div>
        </div>
        @endforeach
    </div>

    <div class="table-container">
        <h3 style="margin-bottom: 15px; font-size: 18px;">5 Transaksi Terakhir</h3>
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Ket / Dompet</th>
                    <th style="text-align: right;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recent as $t)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($t->date)->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $t->type == 'income' ? 'badge-income' : 'badge-expense' }}">
                            {{ $t->type == 'income' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </td>
                    <td>
                        {{ $t->name }} <br>
                        <span style="font-size:11px; color:#64748b;">{{ $t->wallet->name ?? '-' }} | {{ $t->category->name ?? '-' }}</span>
                    </td>
                    <td style="text-align: right; font-family: monospace;">
                        Rp {{ number_format($t->amount, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center; color: #999;">Belum ada data transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>