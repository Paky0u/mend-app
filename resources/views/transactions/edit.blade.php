<x-app-layout>
    <h2 class="page-title">Edit Transaksi</h2>

    <div class="form-card">
        <div class="form-header">Perbarui Data Transaksi</div>
        
        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <input type="hidden" name="type" value="{{ $transaction->type }}">

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-input">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Dompet</label>
                    <select name="wallet_id" class="form-input">
                        @foreach($wallets as $w)
                            <option value="{{ $w->id }}" {{ $transaction->wallet_id == $w->id ? 'selected' : '' }}>
                                {{ $w->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="amount" value="{{ $transaction->amount }}" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <input type="text" name="name" value="{{ $transaction->name }}" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="date" value="{{ $transaction->date }}" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Lampiran (Biarkan kosong jika tidak diubah)</label>
                    <input type="file" name="attachment" class="form-input" accept="image/*,.pdf">
                    @if($transaction->attachment)
                        <small style="display: block; margin-top: 5px;">
                            Lampiran saat ini: <a href="{{ asset('storage/' . $transaction->attachment) }}" target="_blank" style="color: #3b82f6;">Lihat</a>
                        </small>
                    @endif
                </div>

                <div class="form-group" style="margin-top: 10px;">
                    <label class="form-label" style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" name="is_recurring" id="is_recurring_checkbox" value="1" style="width: 18px; height: 18px;" {{ $transaction->is_recurring ? 'checked' : '' }}>
                        Jadikan Transaksi Berulang
                    </label>
                </div>

                <div class="form-group" id="recurring_interval_group" style="display: {{ $transaction->is_recurring ? 'block' : 'none' }}; margin-top: 10px;">
                    <label class="form-label">Interval Berulang</label>
                    <select name="recurring_interval" class="form-input">
                        <option value="daily" {{ $transaction->recurring_interval == 'daily' ? 'selected' : '' }}>Harian</option>
                        <option value="weekly" {{ $transaction->recurring_interval == 'weekly' ? 'selected' : '' }}>Mingguan</option>
                        <option value="monthly" {{ $transaction->recurring_interval == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                        <option value="yearly" {{ $transaction->recurring_interval == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit" style="background-color: #f59e0b;">Update Data</button>
                <a href="{{ url()->previous() }}" class="btn-submit" style="background-color: #64748b; text-decoration: none; display:inline-flex; align-items:center;">Batal</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('is_recurring_checkbox').addEventListener('change', function() {
            document.getElementById('recurring_interval_group').style.display = this.checked ? 'block' : 'none';
        });
    </script>
</x-app-layout>