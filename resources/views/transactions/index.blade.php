<x-app-layout>
    <h2 class="page-title {{ $type == 'income' ? 'title-income' : 'title-expense' }}">
        {{ $type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
    </h2>

    <div class="form-card">
        <div class="form-header">Tambah Data Baru</div>
        <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
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
                        <option value="">-- Pilih --</option> 
                        
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

                <div class="form-group">
                    <label class="form-label">Lampiran (Opsional)</label>
                    <input type="file" name="attachment" class="form-input" accept="image/*,.pdf">
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="form-label" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_recurring" id="is_recurring_checkbox" value="1" style="width: 18px; height: 18px;">
                        Jadikan Transaksi Berulang
                    </label>
                </div>

                <div class="form-group" id="recurring_interval_group" style="display: none; margin-top: 10px;">
                    <label class="form-label">Interval Berulang</label>
                    <select name="recurring_interval" class="form-input">
                        <option value="daily">Harian</option>
                        <option value="weekly">Mingguan</option>
                        <option value="monthly">Bulanan</option>
                        <option value="yearly">Tahunan</option>
                    </select>
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
                    <td>
                        {{ $trx->name }}
                        @if($trx->attachment)
                            <br><a href="{{ asset('storage/' . $trx->attachment) }}" target="_blank" style="font-size: 0.8rem; color: #3b82f6; text-decoration: underline;">📎 Lihat Lampiran</a>
                        @endif
                        @if($trx->is_recurring)
                            <br><span style="font-size: 0.8rem; color: #f59e0b; font-weight: bold;">↻ Berulang: {{ ucfirst($trx->recurring_interval) }}</span>
                        @endif
                    </td>
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
    <script>
        document.getElementById('is_recurring_checkbox').addEventListener('change', function() {
            document.getElementById('recurring_interval_group').style.display = this.checked ? 'block' : 'none';
        });
    </script>
</x-app-layout>