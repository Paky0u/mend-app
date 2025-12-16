<x-app-layout>
    <h2 class="page-title">Edit Transaksi</h2>

    <div class="form-card">
        <div class="form-header">Perbarui Data Transaksi</div>
        
        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
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

                <button type="submit" class="btn-submit" style="background-color: #f59e0b;">Update Data</button>
                <a href="{{ url()->previous() }}" class="btn-submit" style="background-color: #64748b; text-decoration: none; display:inline-flex; align-items:center;">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>