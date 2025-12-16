<x-app-layout>
    <h2 class="page-title">Kelola Dompet / Rekening</h2>

    <div style="display: flex; gap: 30px; align-items: start; flex-wrap: wrap;">
        
        <div class="form-card" style="flex: 1; min-width: 300px;">
            <div class="form-header">Tambah Rekening Baru</div>
            <form action="{{ route('wallet.store') }}" method="POST">
                @csrf
                
                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Nama Bank / E-Wallet</label>
                    <input type="text" name="name" class="form-input" placeholder="Contoh: SeaBank" required>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label class="form-label">Saldo Awal (Rp)</label>
                    <input type="number" name="initial_balance" class="form-input" placeholder="0" required>
                    <small style="color: #94a3b8; font-size: 11px; font-style: italic;">Saldo saat ini di rekening/dompet tersebut.</small>
                </div>

                <div class="form-group" style="margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="is_active" id="activeCheck" value="1" checked style="width: 18px; height: 18px; cursor: pointer;">
                    <label for="activeCheck" style="cursor: pointer; font-size: 14px; color: #334155;">Tampilkan di Dashboard & Pilihan?</label>
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Tambah</button>
            </form>
        </div>

        <div class="table-container" style="flex: 2; min-width: 300px;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dompet</th>
                        <th>Saldo Awal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wallets as $index => $wallet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="font-weight: bold;">{{ $wallet->name }}</div>
                            <span style="font-size: 10px; padding: 2px 6px; border-radius: 4px; background: {{ $wallet->is_active ? '#dcfce7' : '#f1f5f9' }}; color: {{ $wallet->is_active ? '#166534' : '#94a3b8' }};">
                                {{ $wallet->is_active ? 'Ditampilkan' : 'Disembunyikan' }}
                            </span>
                        </td>
                        
                        <td style="font-family: monospace;">
                            Rp {{ number_format($wallet->initial_balance, 0, ',', '.') }}
                        </td>

                        <td style="text-align: center;">
                            <a href="{{ route('wallet.edit', $wallet->id) }}" class="action-btn btn-edit">Edit</a>
                            <form action="{{ route('wallet.destroy', $wallet->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>