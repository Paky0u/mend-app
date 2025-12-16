<x-app-layout>
    <h2 class="page-title">Edit Dompet / Rekening</h2>

    <div class="form-card">
        <div class="form-header">Edit Data Dompet</div>
        
        <form action="{{ route('wallet.update', $wallet->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="form-label">Nama Bank / E-Wallet</label>
                <input type="text" name="name" value="{{ $wallet->name }}" class="form-input" required>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="form-label">Saldo Awal (Rp)</label>
                <input type="number" name="initial_balance" value="{{ $wallet->initial_balance }}" class="form-input" required>
                <small style="color: #94a3b8; font-size: 11px;">Hanya ubah jika kamu salah memasukkan saldo awal sebelumnya.</small>
            </div>

            <div class="form-group" style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_active" id="activeCheck" value="1" {{ $wallet->is_active ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer;">
                <label for="activeCheck" style="cursor: pointer;">Tampilkan di Dashboard & Pilihan?</label>
            </div>

            <button type="submit" class="btn-submit" style="background-color: #f59e0b;">Update</button>
            <a href="{{ route('wallet.index') }}" class="btn-submit" style="background-color: #64748b; text-decoration: none; display: inline-flex; align-items: center;">Batal</a>
        </form>
    </div>
</x-app-layout>