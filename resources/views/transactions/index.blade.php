<x-app-layout>
    <h2 class="page-title {{ $type == 'income' ? 'title-income' : 'title-expense' }}">
        {{ $type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
    </h2>

    <div class="form-card">
        <div class="form-header">Tambah Data Baru</div>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-input" required>
                        <option value="">-- Pilih --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Dompet / Rekening</label>
                    <select name="wallet_id" class="form-input" required>
                        @foreach($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Jumlah (Rp)</label>
                    <input type="number" name="amount" class="form-input" required placeholder="0">
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan (Opsional)</label>
                    <input type="text" name="name" class="form-input" placeholder="Detail...">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-input" required>
                </div>

                <button type="submit" class="btn-submit">Simpan</button>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Dompet</th>
                    <th>Catatan</th>
                    <th style="text-align: right;">Jumlah</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                    <td><span class="badge" style="background: #e2e8f0; color: #334155;">{{ $trx->category->name ?? '-' }}</span></td>
                    <td>{{ $trx->wallet->name ?? '-' }}</td>
                    <td>{{ $trx->name }}</td>
                    <td style="text-align: right; font-weight: bold; color: {{ $type == 'income' ? '#16a34a' : '#dc2626' }};">
                        Rp {{ number_format($trx->amount, 0, ',', '.') }}
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('transaction.edit', $trx->id) }}" class="action-btn btn-edit">Edit</a>
                        
                        <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center; padding: 20px; color:#94a3b8;">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>